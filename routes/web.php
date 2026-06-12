<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/products', function () {
    return view('pages.products');
});

Route::get('/products/{id}', function ($id) {
    return view('pages.product');
});

Route::get('/cart', function () {
    return view('pages.cart');
});

Route::get('/checkout', function () {
    return view('pages.checkout');
});

Route::get('/payment', function () {
    return view('pages.payment');
});

Route::get('/order-success', function () {
    return view('pages.order-success');
});

Route::get('/my-account', function () {
    return view('pages.my-account');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
});

use App\Http\Controllers\CategoryController;

Route::prefix('admin')-> name('admin.')-> group(function(){

    Route::get('/dashboard', function(){
        return view('admin.dashboard');
    }) -> name('dashboard');

    //categories
    Route::resource('categories', CategoryController::class);

});

