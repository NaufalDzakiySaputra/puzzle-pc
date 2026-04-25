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
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())->with('product')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Keranjang kosong!');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

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

        $total = $carts->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });

        DB::beginTransaction();

        try {
            $orderId = 'PUZZLE-' . strtoupper(Str::random(8)) . '-' . time();

            // Simpan transaksi
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'order_id' => $orderId,
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
            ]);

            // Simpan item transaksi
            foreach ($carts as $cart) {
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product_id,
                    'product_name' => $cart->product->name,
                    'price' => $cart->product->price,
                    'quantity' => $cart->quantity,
                ]);

                // Kurangi stok
                $cart->product->decrement('stock', $cart->quantity);
            }

            // Kosongkan keranjang
            Cart::where('user_id', Auth::id())->delete();

            // Siapkan payload untuk Midtrans
            $itemDetails = [];
            foreach ($transaction->items as $item) {
                $itemDetails[] = [
                    'id' => $item->product_id,
                    'price' => (int) $item->price,
                    'quantity' => $item->quantity,
                    'name' => substr($item->product_name, 0, 50),
                ];
            }

            $customerDetails = [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'shipping_address' => [
                    'address' => $request->shipping_address,
                ],
            ];

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $total,
                ],
                'customer_details' => $customerDetails,
                'item_details' => $itemDetails,
            ];

            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Update transaction dengan payment token
            $transaction->update([
                'payment_token' => $snapToken,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId
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