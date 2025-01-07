<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\ProductSize;
use App\Models\OrderProduct;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'product_id', 'product_id')
            ->where('user_id', $this->user_id);
    }


    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size', 'id'); // Link `size` field to `id` in ProductSize
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color', 'id'); // Link `color` field to `id` in ProductColor
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }
    
}
