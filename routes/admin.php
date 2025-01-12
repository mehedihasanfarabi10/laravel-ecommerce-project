<?php

use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Models\ChildCategory;

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('admin/dashboard', [AdminController::class, 'index']);

// });

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
// });


// Route::get('view_size', [AdminController::class, 'view_size'])->middleware(['auth', 'admin']);
// Route::post('add_size', [AdminController::class, 'add_size'])->middleware(['auth', 'admin'])->name('add_size');
// Route::get('view_color', [AdminController::class, 'view_color'])->middleware(['auth', 'admin']);
// Route::post('add_color', [AdminController::class, 'add_color'])->middleware(['auth', 'admin'])->name('add_color');



    



Route::get('view_subcategory',[SubcategoryController::class,'index'])->middleware(['auth','admin'])->name('subcategory.index');
Route::post('subcategory.store',[SubcategoryController::class,'store'])->middleware(['auth','admin'])->name('subcategory.store');
Route::get('delete_subcategory/{id}',[SubcategoryController::class,'destroy'])->middleware(['auth','admin'])->name('delete');
Route::get('edit_subcategory/{id}',[SubcategoryController::class,'edit'])->middleware(['auth','admin'])->name('edit');
Route::post('update_subcategory/{id}',[SubcategoryController::class,'update'])->middleware(['auth','admin'])->name('update');


Route::get('childcategory',[ChildCategoryController::class,'index'])->middleware(['auth','admin'])->name('childcategory.index');
Route::post('store',[ChildCategoryController::class,'store'])->middleware(['auth','admin'])->name('childcategory.store');

Route::get('/get-subcategories/{category}', function ($categoryId) {
    $subcategories = Subcategory::where('category_id', $categoryId)->get();
    return response()->json(['subcategories' => $subcategories]);
});

Route::get('/get-childcategories/{subcategoryId}', function($subcategoryId){
    $childcategories = ChildCategory::where('subcategory_id', $subcategoryId)->get();
    return response()->json(['childcategories' => $childcategories]);
});


Route::get('delete_childcategory/{id}',[ChildCategoryController::class,'destroy'])->middleware(['auth','admin'])->name('childcategory.delete');
Route::get('edit_childcategory/{id}',[ChildCategoryController::class,'edit'])->middleware(['auth','admin'])->name('childcategory.edit');
Route::post('update_childcategory/{id}',[ChildCategoryController::class,'update'])->middleware(['auth','admin'])->name('childcategory.update');
