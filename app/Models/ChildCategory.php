<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    //

    protected $fillable = ['category_id', 'subcategory_id', 'childcategory_name','childcategory_slug'];
    protected $table = 'childcategories';


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
