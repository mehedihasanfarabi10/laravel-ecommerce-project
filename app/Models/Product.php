<?php

namespace App\Models;

use App\Models\Review;
use App\Models\ProductSize;
use App\Models\OrderProduct;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'category_id',
        'size' => 'array',
        'color' => 'array',

        'quantity',
        'is_latest',
        'is_featured',
        'is_hot_deal',

    ];


    protected $casts = [
        'size' => 'array',
        'color' => 'json',
        'gallery_images' => 'array',
    ];

    // Define the relationship with ProductSize
    //  public function sizes()
    //  {
    //      return $this->hasMany(ProductSize::class);
    //  }
    public function sizes()
    {
        return $this->belongsToMany(ProductSize::class, 'product_size', 'product_id', 'size_id');
    }
    public function colors()
    {
        return $this->belongsToMany(ProductColor::class, 'product_color', 'product_id', 'color_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }







    //     return $this->hasMany(ProductSize::class);
    // }

    // public function colors()
    // {
    //     return $this->hasMany(ProductColor::class);
    // }

    // Product Model
    // public function sizes()
    // {
    //     return $this->belongsToMany(ProductSize::class, 'product_sizes as ps', 'product_id', 'size_id')
    //                 ->select('ps.*');  // Optionally, specify which columns to retrieve
    // }


    // public function colors()
    // {
    //     return $this->belongsToMany(ProductColor::class, 'product_colors', 'product_id', 'color_id');
    // }


}
