<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(
    ['prefix' => 'v1'],
    function () {
        Route::post('login', [LoginController::class, 'login']);
        Route::resource('bookings', BookingController::class)->except(
            'destroy',
            'show',
            'update'
        )->middleware('auth');
        Route::get('admin/bookings', [BookingController::class, 'adminIndex'])->middleware('auth');
    }
);
