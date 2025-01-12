<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
    protected $fillable = ['category_id', 'subcategory_name', 'subcategory_slug'];

    protected $table = 'subcategories';


   

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class, 'subcategory_id');
    }
}
