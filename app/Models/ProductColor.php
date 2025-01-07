<?php

namespace App\Models;

use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class ProductColor extends Model
{

    use SoftDeletes;
    protected $fillable = ['color'];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color', 'color_id', 'product_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class, 'color_id');
    // }
}
