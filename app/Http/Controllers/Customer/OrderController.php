<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        
        $transactions = Transaction::where('user_id', Auth::id())
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->load('items.product');

        return view('customer.orders.show', compact('transaction'));
    }

    /**
     
     */
    public function cekStatus($order_id)
    {
        // Cari transaksi di database
        $transaction = Transaction::where('order_id', $order_id)->first();
        
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Ambil Server Key dari config
        $serverKey = config('midtrans.server_key');
        $authString = base64_encode($serverKey . ':');
        
        // Panggil API Midtrans untuk cek status
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $authString,
            'Accept' => 'application/json',
        ])->get("https://api.sandbox.midtrans.com/v2/{$order_id}/status");
        
        if ($response->successful()) {
            $data = $response->json();
            
            
            if (in_array($data['transaction_status'], ['capture', 'settlement'])) {
                $transaction->update([
                    'status' => 'paid',
                    'payment_type' => $data['payment_type'] ?? 'unknown',
                    'midtrans_response' => json_encode($data)
                ]);
                
                return redirect()->route('orders.index')
                    ->with('success', '✅ Pembayaran berhasil dikonfirmasi!');
                    
            } elseif ($data['transaction_status'] == 'pending') {
                return redirect()->back()
                    ->with('info', '⏳ Pembayaran masih pending. Silakan selesaikan pembayaran Anda.');
            } else {
                return redirect()->back()
                    ->with('error', 'Status pembayaran: ' . $data['transaction_status']);
            }
        }
        
        return redirect()->back()
            ->with('error', 'Gagal menghubungi server pembayaran. Silakan coba lagi.');
    }
}