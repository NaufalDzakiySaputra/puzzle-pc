<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'total_amount',
        'status',
        'payment_type',
        'payment_token',
        'shipping_address',
        'midtrans_response',
    ];

    protected $casts = [
        'midtrans_response' => 'array', // Otomatis cast JSON ke array
        'total_amount' => 'integer',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Transaction Items
     */
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    /**
     * Cek status pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Cek status paid (lunas)
     */
    public function isPaid()
    {
        return $this->status === 'paid';
    }

    /**
     * Cek status failed
     */
    public function isFailed()
    {
        return $this->status === 'failed';
    }

    /**
     * Cek status expired
     */
    public function isExpired()
    {
        return $this->status === 'expired';
    }

    /**
     * Format total amount ke Rupiah
     */
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Ambil response dari Midtrans
     */
    public function getMidtransResponseAttribute($value)
    {
        return json_decode($value, true);
    }
}