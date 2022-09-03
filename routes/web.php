<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;
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

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

    Route::group(['midleware' => 'can:view'], function() {
        Route::resource('user', UserController::class);
        Route::resource('reports', ReportsController::class);
    });

    Route::resource('deceased', DeceasedController::class);
    Route::get('/deceased/list/all/{isDeleted?}', [DeceasedController::class, 'list'])->name('deceased.list');
    Route::get('/deceased/deleted/records', [DeceasedController::class, 'deleted'])->name('deceased.deleted');
    Route::put('/deceased/approval/{deceased}', [DeceasedController::class, 'approve'])->name('deceased.approve');

    // change pin
    Route::post('/auth/change-pin', [LoginController::class, 'changePIN'])->name('change-pin');
    Route::get('/auth/change-pin', [LoginController::class, 'showChangePinForm'])->name('change-pin.form');

    Route::post('/lighting', [LightingController::class, 'store'])->name('lighting.store');
    Route::get('/lighting/{lighting}', [LightingController::class, 'show'])->name('lighting.show');
    Route::get('/lighting/{lighting}/pasuga', [LightingController::class, 'lighting'])->name('lighting.lighting');
    Route::delete('/lighting/{lighting}', [LightingController::class, 'delete'])->name('lighting.delete');
});
