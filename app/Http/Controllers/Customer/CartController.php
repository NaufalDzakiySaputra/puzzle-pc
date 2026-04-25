<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
            
        $total = $carts->sum(function($cart) {
            return $cart->product->price * $cart->quantity;
        });
        
        return view('customer.cart.index', compact('carts', 'total'));
    }
    
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock
        ]);
        
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();
            
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }
        
        return redirect()->route('cart.index')
            ->with('success', 'Produk ditambahkan ke keranjang!');
    }
    
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $cart->product->stock
        ]);
        
        $cart->update(['quantity' => $request->quantity]);
        
        return redirect()->route('cart.index')
            ->with('success', 'Keranjang berhasil diupdate!');
    }
    
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }
        
        $cart->delete();
        
        return redirect()->route('cart.index')
            ->with('success', 'Produk dihapus dari keranjang!');
    }
}