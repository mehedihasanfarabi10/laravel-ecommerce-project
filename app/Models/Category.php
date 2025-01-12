<?php

namespace App\Models;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $fillable = [
        'category_name',
        'category_slug'
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }


    
    
    

}
