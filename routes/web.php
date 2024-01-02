<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;
use App\Http\Controllers\toyyibpayController;

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



Route::get('/order-list', [userController::class, 'listUserOrder']);

Route::get('/', function () {
    return view('welcome');
});


Route::view('/home', 'home');
Route::view('/shop', 'shop');
Route::view('/cart', 'cart');
Route::view('/order-paid', 'order-paid');

Route::get('/shop', [userController::class, 'listItems'])->name('shop');

Route::get('/add-to-cart/{item_id?}', [userController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart', [userController::class, 'listCartItems'])->name('cart');
Route::get('/remove/{cart_id?}', [userController::class, 'removeCartItem'])->name('remove');
Route::post('/checkout', [userController::class, 'checkout'])->name('checkout');


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', [adminController::class, 'listItems'])->name('dashboard');
    Route::get('/order', [adminController::class, 'listOrders'])->name('order');
    Route::get('/update-item/{item_id?}', [adminController::class, 'selectItem'])->name('update-form');
    Route::get('/sold-item/{item_id?}', [adminController::class, 'soldItem'])->name('sold-item');
    Route::get('/available-item/{item_id?}', [adminController::class, 'availableItem'])->name('available-item');
    Route::POST('/update/{item_id?}', [adminController::class, 'updateItem']);
    Route::view('/add-item', 'add-item')->name('add-item');
    Route::POST('/add', [adminController::class, 'addItem']);
    Route::get('/delete/{item_id?}', [adminController::class, 'deleteItem']);
    
});

Route::get('/toyyibpay/{total_cart?}', [adminController::class, 'createBill'])->name('toyyibpay');
Route::get('/toyyibpay-status', [adminController::class, 'paymentStatus'])->name('toyyibpay-status');
Route::get('/toyyibpay-callback', [adminController::class, 'callback'])->name('toyyibpay-callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/logout', [userController::class, 'destroy']);

require __DIR__.'/auth.php';
