<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Filter kategori
        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }
        
        // Pencarian
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->where('stock', '>', 0)->latest()->paginate(12);
        
        $categories = Product::distinct()->pluck('category');
        
        return view('customer.shop.index', compact('products', 'categories'));
    }
    
    public function show(Product $product)
    {
        return view('customer.shop.show', compact('product'));
    }
}