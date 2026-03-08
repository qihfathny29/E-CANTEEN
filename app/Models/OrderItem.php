<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'menu_id', 'jumlah', 'harga_satuan', 'subtotal', 'catatan'];

    //relasi: 1 order_item dimiliki oleh 1 order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    //relasi: 1 order_item dimiliki oleh 1 menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
