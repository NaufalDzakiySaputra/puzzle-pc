<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // ✅ Pakai config() bukan env()
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Keranjang kosong!');
        }

        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        return view('customer.checkout.index', compact('carts', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10'
        ]);

        $carts = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($carts->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong!'
            ], 400);
        }

        $total = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);

        DB::beginTransaction();

        try {
            $orderId = 'PUZZLE-' . strtoupper(Str::random(8)) . '-' . time();

            // Simpan transaksi
            $transaction = Transaction::create([
                'user_id'          => Auth::id(),
                'order_id'         => $orderId,
                'total_amount'     => $total,
                'status'           => 'pending',
                'shipping_address' => $request->shipping_address,
            ]);

            // Simpan item & siapkan item_details sekaligus
            $itemDetails = [];
            foreach ($carts as $cart) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id'     => $cart->product_id,
                    'product_name'   => $cart->product->name,
                    'price'          => $cart->product->price,
                    'quantity'       => $cart->quantity,
                ]);

                $itemDetails[] = [
                    'id'       => $cart->product_id,
                    'price'    => (int) $cart->product->price,
                    'quantity' => $cart->quantity,
                    'name'     => substr($cart->product->name, 0, 50),
                ];
            }

            // ✅ Siapkan params Midtrans dengan notification_url
            $params = [
                'transaction_details' => [
                    'order_id'     => $orderId,
                    'gross_amount' => (int) $total,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email'      => Auth::user()->email,
                ],
                'item_details' => $itemDetails,

                // ✅ INI YANG PALING PENTING — hardcode URL ngrok kamu di sini
                // Ganti dengan URL ngrok terbaru setiap kali restart ngrok
                'callbacks' => [
                    'notification' => env('MIDTRANS_NOTIFICATION_URL', url('/api/midtrans/callback')),
                ],
            ];

            // Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Update token
            $transaction->update(['payment_token' => $snapToken]);

            // ✅ Baru hapus cart SETELAH token berhasil didapat
            Cart::where('user_id', Auth::id())->delete();

            // ✅ Baru kurangi stok SETELAH token berhasil didapat
            foreach ($carts as $cart) {
                $cart->product->decrement('stock', $cart->quantity);
            }

            DB::commit();

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken,
                'order_id'   => $orderId,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}