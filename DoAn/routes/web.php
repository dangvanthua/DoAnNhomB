<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CrudProductController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(CrudUserController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'authUser')->name('auth.user');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'postRegister')->name('post.register');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/account', 'viewAccountInfo')->name('account');
    Route::get('/list_user', 'listUser')->name('user.list');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('home', 'home')->name('home');
    Route::get('products', 'getProducts')->name('products');
    Route::get('product-detail/{productId}', 'getProductDetail')->name('products.detail');
    Route::get('product-search', 'search')->name('products.search');
    Route::get('cart', 'cartDetail')->name('products.cart');
    Route::post('add-to-cart', 'addToCart')->middleware('storePreviousUrl')->name('products.addToCart');
    Route::post('cart/delete', 'deleteCart')->name('cart.delete');
    Route::post('cart/update', 'updateCart')->name('cart.update');
});

Route::controller(CheckoutController::class)->group(function () {
    Route::post('checkout', 'checkout')->name('products.checkout');
    Route::get('checkout-detail', 'showCheckoutPage')->name('checkout.detail');
    Route::post('checkout/process', 'processCheckout')->name('checkout.process');
    Route::get('order-success', 'showOrderSuccess')->name('orders.success');
    Route::get('order-history', 'showOrderHistory')->name('orders.history');
});


Route::controller(CrudProductController::class)->group(function () {
    Route::get('productmanagement', 'productManagement')->name('product.productManagement');
    Route::post('/filter-products', 'filterProducts')->name('filter.products');
    Route::get('addproduct', 'addProduct')->name('product.addProduct');
    Route::post('addproduct', 'store')->name('product.store');
    Route::get('editproduct/{product_id}', 'editProduct')->name('product.editProduct');
    Route::put('editproduct/{product_id}', 'update')->name('product.update');
    Route::delete('deleteproduct/{id}', 'deleteProduct')->name('product.deleteProduct');
});



Route::get('/', function () {
    return view('welcome');
});
