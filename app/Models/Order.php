<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'waktu_ambil', 'status', 'total_harga', 'metode_bayar'];

    // relasi: 1 order punya banyak order_items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Relasi: 1 order dimiliki oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
