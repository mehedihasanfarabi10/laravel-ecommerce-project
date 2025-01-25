
<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;


Route::get('view_orders',[OrderController::class,'view_orders'])->middleware(['auth','admin']);
Route::get('on_the_way/{id}',[OrderController::class,'on_the_way'])->middleware(['auth','admin']);
Route::get('delievered/{id}',[OrderController::class,'delievered'])->middleware(['auth','admin']);
Route::get('cancelled/{id}',[OrderController::class,'cancelled'])->middleware(['auth','admin']);
Route::get('print_pdf/{id}',[OrderController::class,'print_pdf'])->middleware(['auth','admin']);
Route::post('delete_order/{id}',[OrderController::class,'delete_order'])->middleware(['auth','admin']);

Route::post('/place_order', [OrderController::class, 'place_order'])->middleware(['auth', 'verified']);
Route::get('/myorders', [OrderController::class, 'myorders'])->middleware(['auth', 'verified']);

Route::get('order_search', [OrderController::class, 'order_search'])->middleware(['auth', 'admin']);
// Route::get('/checkout', [HomeController::class, 'index'])->name('checkout');


Route::get('print_pdf_user/{id}',[OrderController::class,'print_pdf_user']);


Route::get('track/order/',[OrderController::class,'tracking'])->name('track.order');
Route::get('track/order/search',[OrderController::class,'track_order'])->name('track_order');