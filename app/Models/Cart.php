<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id','size','color','quantity'];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'size', 'id'); // Link `size` field to `id` in ProductSize
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'color', 'id'); // Link `color` field to `id` in ProductColor
    }
}

