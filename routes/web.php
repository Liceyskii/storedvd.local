<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::post('/', [MainController::class, 'index']);
Route::get('/search', [MainController::class, 'search'])->name('search');
Route::get('/movie/{id}', [MainController::class, 'movieView'])->name('movieView');
Route::get('/delivery', [MainController::class, 'delivery'])->name('delivery');
Route::get('/contacts', [MainController::class, 'contacts'])->name('contacts');

Route::get('/genre', [MainController::class, 'sortByGenre'])->name('genre');

Route::get('/cart', [MainController::class, 'cart'])->name('cart');
Route::post('/cart', [MainController::class, 'updateCart']);
Route::get('/cart/delete/{id}', [MainController::class, 'deletePosition']);
Route::get('/order', [MainController::class, 'order'])->name('order');
Route::post('/order/add', [MainController::class, 'addOrder']);
Route::get('/ordersuccess', [MainController::class, 'orderSuccess'])->name('success');