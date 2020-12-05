<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::any('(.*)', function () {
    Artisan::call('storage:link');
});

Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{id}/products',[App\Http\Controllers\ProductController::class, 'index'])->name('products');

Route::get('/cart',[App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart',[App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
Route::post('/cart/saved-items/{id}',[App\Http\Controllers\CartController::class, 'saveForLater'])->name('cart.savedItems');
Route::delete('/cart/{id}',[App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
//Routes for saved items section
Route::post('/cart/saved-for-later/{id}',[App\Http\Controllers\SavedItemsController::class, 'movetoCart'])->name('savedItems.toCart');
Route::delete('/saved-for-later/{id}',[App\Http\Controllers\SavedItemsController::class, 'destroy'])->name('savedItems.destroy');
//Checkout route
Route::get('/checkout',[App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout',[App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
//Guest checkout
Route::get('/checkoutGuest',[App\Http\Controllers\CheckoutController::class, 'index'])->name('checkoutGuest.index');
//Search product
Route::get('/search',[App\Http\Controllers\HomeController::class, 'search'])->name('search');
//User account/profile
Route::middleware('auth')->group(function(){
    Route::get('/my-profile',[App\Http\Controllers\UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/my-profile',[App\Http\Controllers\UserProfileController::class, 'update'])->name('profile.update');
    //Orders
    Route::get('/my-orders',[App\Http\Controllers\OrdersController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}',[App\Http\Controllers\OrdersController::class, 'show'])->name('orders.show');
    //Upload profile picture
    Route::post('/my-profile/upload',[App\Http\Controllers\UserProfileController::class, 'uploadAvatar'])->name('profile.upload');
    
});


