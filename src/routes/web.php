<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReviewController;

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
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::view('/thanks', 'thanks')->name('thanks');

// Shop routes
Route::get('/shop_all', [RestaurantController::class, 'index'])->name('shop_all');

Route::get('/detail/{id}', [ReservationController::class, 'show'])->name('restaurant.show');
Route::get('/done', [ReservationController::class, 'done'])->name('done');

// Favorite routes
Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
Route::post('/favorites/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/', [LoginController::class, 'shop_all'])->name('home');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');
    Route::delete('/reservation/{id}', [MypageController::class, 'destroyReservation'])->name('reservation.destroy');
    Route::put('/reservation/{id}', [MypageController::class, 'updateReservation'])->name('reservation.update');

    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');

    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    
});