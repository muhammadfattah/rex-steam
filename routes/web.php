<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageGameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
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

Route::middleware(['guest'])->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::resource('/manage-game', ManageGameController::class)->except('show')->middleware('can:admin');

    Route::get('/profile', [ProfileController::class, 'index']);
    Route::post('/profile', [ProfileController::class, 'update']);

    Route::middleware(['can:member'])->group(function () {
        Route::get('/shopping-cart', [CartController::class, 'index']);
        Route::post('/shopping-cart/{id}', [CartController::class, 'addItem']);
        Route::delete('/shopping-cart/{id}', [CartController::class, 'deleteItem']);

        Route::get('/checkout', [TransactionController::class, 'index']);
        Route::post('/checkout', [TransactionController::class, 'store']);

        Route::get('/transaction-receipt', [TransactionController::class, 'receipt']);
        Route::get('/transaction-history', [TransactionController::class, 'history']);

        Route::get('/friends', [FriendController::class, 'index']);
        Route::post('/friends', [FriendController::class, 'addFriend']);
        Route::post('/friends/{id}', [FriendController::class, 'store']);
        Route::delete('/friends/{id}', [FriendController::class, 'delete']);
    });
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/games', [HomeController::class, 'searchGames']);
Route::get('{game}/check-age', [HomeController::class, 'checkAge']);
Route::post('{game}/check-age', [HomeController::class, 'confirmAge']);
Route::get('/{game}', [HomeController::class, 'detail']);
