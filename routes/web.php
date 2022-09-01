<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\LightingController;
use App\Http\Controllers\Auth\LoginController;

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

Auth::routes([
    'register' => false
]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('deceased', DeceasedController::class);
    Route::get('/deceased/list/all/{isDeleted?}', [DeceasedController::class, 'list'])->name('deceased.list');

    // change pin
    Route::post('/auth/change-pin', [LoginController::class, 'changePIN'])->name('change-pin');
    Route::get('/auth/change-pin', [LoginController::class, 'showChangePinForm'])->name('change-pin.form');

    Route::get('/lighting/{lighting}', [LightingController::class, 'show'])->name('lighting.show');
});
