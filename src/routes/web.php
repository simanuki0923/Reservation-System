<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreRepresentativeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Auth\CustomEmailVerificationController;
use App\Http\Controllers\QRController;

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
Route::middleware(['web'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::view('/thanks', 'thanks')->name('thanks');

    Route::get('/shop_all', [RestaurantController::class, 'index'])->name('shop_all');
    Route::get('/detail/{id}', [ReservationController::class, 'show'])->name('restaurant.show');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/done', [ReservationController::class, 'done'])->name('done');
    Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/favorites/toggle/{id}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    Route::middleware('auth')->group(function () {
        Route::get('/', [LoginController::class, 'shop_all'])->name('home');
        Route::get('/mypage', [MypageController::class, 'mypage'])->name('mypage');
        Route::delete('/reservation/{id}', [MypageController::class, 'destroyReservation'])->name('reservation.destroy');
        Route::put('/reservation/{id}', [MypageController::class, 'updateReservation'])->name('reservation.update');
        Route::get('/reviews/create', [ReviewController::class, 'create'])->name('review.create');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('review.store');   
    });

    //メール認証
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [CustomEmailVerificationController::class, 'verify'])
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/profile', function () {
        return view('profile'); // プロフィールページを表示
    })->middleware(['auth', 'verified'])->name('profile');

    Route::get('/admin-login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/admin-login', [AdminLoginController::class, 'store'])->name('admin.login.store');
    Route::post('/admin-logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

    // 管理者用ルート
    Route::middleware(['auth:admin', 'role:administrator'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/create-manager', [AdminController::class, 'createManager'])->name('admin.createManager');
        Route::post('/admin/store-manager', [AdminController::class, 'storeManager'])->name('admin.storeManager');
        Route::get('/admin/managers', [AdminController::class, 'listManagers'])->name('admin.managers');
        Route::get('/admin/managers/{id}/edit', [AdminController::class, 'editManager'])->name('admin.editManager');
        Route::put('/admin/managers/{id}', [AdminController::class, 'updateManager'])->name('admin.updateManager');
        Route::delete('/admin/managers/{id}', [AdminController::class, 'deleteManager'])->name('admin.deleteManager');
    });

    // 店舗代表者用ルート
    Route::middleware(['auth:admin', 'role:store_representative'])->group(function () {
        Route::get('/store/dashboard', [StoreRepresentativeController::class, 'index'])->name('store.dashboard');
        Route::get('/store/create', [StoreRepresentativeController::class, 'create'])->name('store.create');
        Route::post('/store', [StoreRepresentativeController::class, 'store'])->name('store.store');
        Route::get('/store/reservations', [StoreRepresentativeController::class, 'reservations'])->name('store.reservations');
        Route::get('/store/{id}/edit', [StoreRepresentativeController::class, 'edit'])->name('store.edit');
        Route::put('/store/{id}', [StoreRepresentativeController::class, 'update'])->name('store.update');
        Route::delete('/store/{id}', [StoreRepresentativeController::class, 'destroy'])->name('store.destroy');

        Route::get('/store/upload', [StoreRepresentativeController::class, 'uploadForm'])->name('store.upload');
        Route::post('/store/upload', [StoreRepresentativeController::class, 'upload'])->name('store.upload.post');

        Route::get('/mail', [MailController::class, 'index'])->name('mail.index');
        Route::post('/mail', [MailController::class, 'send'])->name('mail.send');

        Route::get('/store/qr-scan', [StoreRepresentativeController::class, 'qrScan'])->name('store.qr.scan');
        Route::post('/store/check-reservation', [StoreRepresentativeController::class, 'checkReservation'])->name('store.check.reservation');

        Route::get('/store/reservations/{id}', [StoreRepresentativeController::class, 'show'])->name('store.reservation.detail');


    });
});
