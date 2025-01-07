
<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CartController;


Route::get('/add_cart/{id}',[CartController::class,'add_to_cart'])->name('add.cart')->middleware(['auth']);
Route::get('/mycart',[CartController::class,'mycart'])->middleware(['auth', 'verified']);
Route::post('/remove_from_cart/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware(['auth', 'verified']);
Route::post('update-cart/{id}', [CartController::class, 'update_cart_quantity']);
