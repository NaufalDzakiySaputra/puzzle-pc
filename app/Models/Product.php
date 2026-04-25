<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'category'
    ];

    // Relasi ke cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi ke transaction items
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }
}