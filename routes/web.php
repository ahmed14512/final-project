<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Frontend / Customer Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [ShopController::class, 'index'])
     ->name('products.index');

Route::get('/products/{id}', [ShopController::class, 'show'])
     ->name('products.show');

Route::post('/checkout/place-order', [CheckoutController::class, 'store'])
     ->name('checkout.store');

Route::get('/order-success/{order}', [OrderController::class, 'success'])
     ->name('order.success');

Route::get('/my-account', function () {
    return view('pages.my-account');
    
});

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
     ->name('cart.index');

Route::post('/cart/add', [CartController::class, 'add'])
     ->name('cart.add');

Route::post('/cart/buy-now', [CartController::class, 'buyNow'])
     ->name('cart.buyNow');

Route::patch('/cart/{cart}', [CartController::class, 'update'])
     ->name('cart.update');

Route::delete('/cart/clear', [CartController::class, 'clear'])
     ->name('cart.clear');

Route::delete('/cart/{cart}', [CartController::class, 'remove'])
     ->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Checkout & Payment Routes
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [CheckoutController::class, 'index'])
     ->name('checkout.index');

Route::post('/checkout/address', [CheckoutController::class, 'saveAddress'])
     ->name('checkout.saveAddress');

Route::get('/payment', [CheckoutController::class, 'payment'])
     ->name('payment.index');

/*
|--------------------------------------------------------------------------
| Admin Routes (protected by auth + admin middleware)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
     ->name('admin.')
     ->middleware(['auth', 'admin'])
     ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
          ->name('dashboard');

    // Categories
    Route::resource('categories', CategoryController::class)
         ->except(['show']);

    // Brands
    Route::resource('brands', BrandController::class)
         ->except(['show']);

    // Products
    Route::resource('products', ProductController::class)
         ->except(['show']);

    // Delete single product thumbnail (plain GET link, no JS/form)
    Route::get('products/images/{image}/delete',
        [ProductImageController::class, 'destroy'])
        ->name('products.images.destroy');

    // Users
    Route::resource('users', UserController::class)
         ->except(['show']);

     //customers  
     Route::get('customers', [CustomerController::class, 'index'])
          ->name('customers.index');

     Route::get('customers/{customer}', [CustomerController::class, 'show'])
          ->name('customers.show');

     //report
     Route::get('reports', [ReportController::class, 'index'])
     ->name('reports.index');

});

/*
|--------------------------------------------------------------------------
| Breeze Auth Routes (login, register, password reset, etc.)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
     ->name('admin.')
     ->middleware(['auth', 'admin'])
     ->group(function () {

    // Orders
    Route::get('orders', [AdminOrderController::class, 'index'])
          ->name('orders.index');

     Route::get('orders/{order}', [AdminOrderController::class, 'show'])
          ->name('orders.show');

     Route::put('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
          ->name('orders.updateStatus');

});

Route::middleware('auth')->group(function () {
    Route::get('/my-account', [AccountController::class, 'index'])
         ->name('account.index');

    Route::post('/my-account/profile', [AccountController::class, 'updateProfile'])
         ->name('account.updateProfile');

    Route::post('/my-account/password', [AccountController::class, 'updatePassword'])
         ->name('account.updatePassword');

    Route::post('/my-account/address', [AccountController::class, 'saveAddress'])
         ->name('account.saveAddress');
});






require __DIR__.'/auth.php';