<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // protected $fillable = ['order_id', 'product_id', 'size_id', 'color_id', 'quantity', 'price'];

    // public function size()
    // {
    //     return $this->belongsTo(ProductSize::class, 'size_id');
    // }

    // public function color()
    // {
    //     return $this->belongsTo(ProductColor::class, 'color_id');
    // }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // public function order()
    // {
    //     return $this->belongsTo(Order::class);
    // }

    // public function size()
    // {
    //     return $this->belongsTo(ProductSize::class, 'size_id');
    // }

    // public function color()
    // {
    //     return $this->belongsTo(ProductColor::class, 'color_id');
    // }
}
