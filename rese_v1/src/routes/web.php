<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QRcodeController;
use Illuminate\Support\Facades\Auth;

Route::get('/thanks', function () {
    return view('thanks');
});

//Route::get('/dashboard', function () {
  //  return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurants/{id}', [RestaurantController::class, 'detail'])->name('restaurants.detail');

Route::post('/favorite/{restaurant}', [FavoriteController::class, 'toggle'])->name('favorite.toggle');

Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/restaurants/{restaurant_id}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
Route::get('/done', [ReservationController::class, 'done'])->name('reservation.done');
Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');



Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');




Route::get('/previous-page', function () {
    $previousPageUrl = session('previous_page_url');
    return redirect()->to($previousPageUrl);
})->name('previous-page');

Route::post('/upload', [StorageController::class, 'store'])->name('images.upload.store');

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
});

require __DIR__.'/auth.php';

Route::post('/reservations/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');

Route::get('/qr-code/{reservation_id}', [QRcodeController::class, 'generate'])->name('qr-code.generate');