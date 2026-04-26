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

    public function cekStatus($order_id)
    {
        // ✅ Cari transaksi + pastikan milik user yang login
        $transaction = Transaction::where('order_id', $order_id)
            ->where('user_id', Auth::id()) // ← Security fix
            ->first();

        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // ✅ Pakai config() — aman karena sudah ada config/midtrans.php
        $serverKey = config('midtrans.server_key');
        $baseUrl   = config('midtrans.base_url');
        $authString = base64_encode($serverKey . ':');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $authString,
            'Accept'        => 'application/json',
        ])->get("{$baseUrl}/{$order_id}/status");

        if (!$response->successful()) {
            return redirect()->back()
                ->with('error', 'Gagal menghubungi server pembayaran. Silakan coba lagi.');
        }

        $data              = $response->json();
        $transactionStatus = $data['transaction_status'] ?? null;
        $fraudStatus       = $data['fraud_status'] ?? null;

        // ✅ Mapping status dengan fraud_status check
        if ($transactionStatus === 'capture') {
            $status = $fraudStatus === 'accept' ? 'paid' : 'challenge';
        } elseif ($transactionStatus === 'settlement') {
            $status = 'paid';
        } elseif ($transactionStatus === 'pending') {
            $status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'cancel'])) {
            $status = 'failed';
        } elseif ($transactionStatus === 'expire') {
            $status = 'expired';
        } else {
            $status = $transaction->status; // Tidak diubah kalau tidak dikenal
        }

        $transaction->update([
            'status'            => $status,
            'payment_type'      => $data['payment_type'] ?? $transaction->payment_type,
            'midtrans_response' => json_encode($data),
        ]);

        // ✅ Response berdasarkan status
        return match ($status) {
            'paid'      => redirect()->route('orders.index')
                            ->with('success', '✅ Pembayaran berhasil dikonfirmasi!'),
            'pending'   => redirect()->back()
                            ->with('info', '⏳ Pembayaran masih pending. Silakan selesaikan pembayaran.'),
            'challenge' => redirect()->back()
                            ->with('warning', '⚠️ Pembayaran sedang direview. Mohon tunggu konfirmasi.'),
            default     => redirect()->back()
                            ->with('error', 'Status pembayaran: ' . $transactionStatus),
        };
    }
}