<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServicrProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    Route::middleware('web')
        ->group(base_path('routes/web.php'));

    Route::middleware('web')
        // ->prefix('admin')
        ->group(base_path('routes/admin.php'));

    Route::middleware('web')
        ->group(base_path('routes/cart.php'));

    Route::middleware('web')
        ->group(base_path('routes/page.php'));

    Route::middleware('web')
        ->group(base_path('routes/order.php'));

    Route::middleware('web')
        ->group(base_path('routes/product.php'));
    }
}
