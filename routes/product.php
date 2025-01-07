

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ProductController;


Route::get('add_product', [ProductController::class, 'add_product'])->middleware(['auth', 'admin']);
Route::get('view_product', [ProductController::class, 'view_product'])->name('view.product')->middleware(['auth', 'admin']);
Route::get('delete_product/{id}', [ProductController::class, 'delete_product'])->middleware(['auth', 'admin']);
Route::get('edit_product/{id}', [ProductController::class, 'edit_product'])->middleware(['auth', 'admin']);
Route::get('product_search', [ProductController::class, 'product_search'])->middleware(['auth', 'admin']);
Route::post('/update_product/{id}', [ProductController::class, 'update_product'])->name('product.update');

Route::post('upload_product', [ProductController::class, 'upload_product'])->middleware(['auth', 'admin']);
Route::get('/product_details/{id}',[ProductController::class,'product_details']);

Route::get('category_search', [ProductController::class, 'category_search'])->middleware(['auth', 'admin']);
Route::get('product_search2', [HomeController::class, 'product_search2'])->middleware(['auth', 'admin']);
// Products
// Route::resource('products', ProductController::class);

Route::delete('/delete-gallery-image/{image}', [ProductController::class, 'deleteGalleryImage']);


Route::post('/product/{id}/review', [ProductController::class, 'storeReview'])->name('product.review');

