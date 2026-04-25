<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')
            ->latest()
            ->paginate(15);
            
        return view('admin.orders.index', compact('transactions'));
    }
    
    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'items.product']);
        
        return view('admin.orders.show', compact('transaction'));
    }
    
    public function updateStatus(Request $request, Transaction $transaction)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,expired'
        ]);
        
        $transaction->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }
}