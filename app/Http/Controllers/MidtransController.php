<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // Log untuk debugging
        Log::info('Midtrans Callback received:', $request->all());

        // Validasi status_code (opsional)
        $validStatusCodes = ['200', '201', '202'];
        if (!in_array($request->status_code, $validStatusCodes)) {
            Log::warning('Invalid status code: ' . $request->status_code);
            return response()->json(['message' => 'Invalid status code'], 400);
        }

        // Ambil Server Key langsung dari .env
        $serverKey = env('MIDTRANS_SERVER_KEY');  // ← LANGSUNG DARI ENV

        // Verifikasi signature
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            Log::warning('Invalid signature for order_id: ' . $request->order_id);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Cari transaksi
        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            Log::warning('Transaction not found: ' . $request->order_id);
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Mapping status
        $status = match ($request->transaction_status) {
            'capture', 'settlement' => 'paid',
            'pending' => 'pending',
            'deny', 'cancel' => 'failed',
            'expire' => 'expired',
            default => 'pending',
        };

        // Payment type dengan fallback
        $paymentType = $request->payment_type ?? 'unknown';

        // Update transaksi
        $transaction->update([
            'status' => $status,
            'payment_type' => $paymentType,
            'midtrans_response' => json_encode($request->all())
        ]);

        Log::info("Transaction {$transaction->order_id} updated: status={$status}, payment_type={$paymentType}");

        return response()->json(['message' => 'OK'], 200);
    }
}