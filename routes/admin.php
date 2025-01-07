<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;

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



    


Route::get('view_category',[CategoryController::class,'view_category'])->middleware(['auth','admin']);
Route::post('add_category',[CategoryController::class,'add_category'])->middleware(['auth','admin']);
Route::get('delete_category/{id}',[CategoryController::class,'delete_category'])->middleware(['auth','admin']);
Route::get('edit_category/{id}',[CategoryController::class,'edit_category'])->middleware(['auth','admin']);
Route::post('update_category/{id}',[CategoryController::class,'update_category'])->middleware(['auth','admin']);


