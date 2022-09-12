<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\LightingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DefaultCertificateController;

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

    Route::group(['middleware' => 'can:view'], function() {
        // Users
        Route::resource('user', UserController::class);
        Route::group(['prefix' => 'defaults', 'as' => 'defaults.'], function () {
            Route::get('/', [DefaultCertificateController::class, 'index'])->name('index');
            Route::get('/list/json', [DefaultCertificateController::class, 'list'])->name('list');
            Route::put('/{default}', [DefaultCertificateController::class, 'update'])->name('update');
        });
        // Reports
        Route::group(['prefix' => 'reports', 'as' => 'reports.'], function() {
            Route::get('/', [ReportsController::class, 'index'])->name('index');
            Route::post('/', [ReportsController::class, 'store'])->name('store');
            Route::get('/{report}', [ReportsController::class, 'show'])->name('show');
            Route::put('/{report}', [ReportsController::class, 'update'])->name('update');
            Route::delete('/{report}', [ReportsController::class, 'destroy'])->name('destroy');
            Route::post('/template', [ReportsController::class, 'report'])->name('report');
        });
    });

    // Deceased
    Route::resource('deceased', DeceasedController::class);
    Route::get('/deceased/import/record', [DeceasedController::class, 'import'])->name('deceased.import');
    Route::get('/deceased/list/all/{isDeleted?}', [DeceasedController::class, 'list'])->name('deceased.list');
    Route::get('/deceased/deleted/records', [DeceasedController::class, 'deleted'])->name('deceased.deleted');
    Route::put('/deceased/approval/{deceased}', [DeceasedController::class, 'approve'])->name('deceased.approve');
    Route::get('/deceased/list/expired', [DeceasedController::class, 'expired'])->name('deceased.expired.index');
    Route::post('/deceased/list/expired', [DeceasedController::class, 'expired'])->name('deceased.expired');

    // Payment
    Route::resource('payment', PaymentController::class);

    // change pin
    Route::post('/auth/change-pin', [LoginController::class, 'changePIN'])->name('change-pin');
    Route::get('/auth/change-pin', [LoginController::class, 'showChangePinForm'])->name('change-pin.form');

    // Lighting
    Route::post('/lighting', [LightingController::class, 'store'])->name('lighting.store');
    Route::get('/lighting/{lighting}', [LightingController::class, 'show'])->name('lighting.show');
    Route::post('/lighting/{lighting}', [LightingController::class, 'update'])->name('lighting.update');
    Route::delete('/lighting/{lighting}', [LightingController::class, 'delete'])->name('lighting.delete');
    Route::get('/lighting/{lighting}/pasuga', [LightingController::class, 'lighting'])->name('lighting.lighting');

    // Contract
    Route::resource('contract', ContractController::class);
    Route::group(['prefix' => 'contract', 'as' => 'contract.'], function () {
        Route::get('/contract/{id?}', [ContractController::class, 'index'])->name('index');
        Route::post('/contract', [ContractController::class, 'store'])->name('store');
        Route::get('/contract/create', [ContractController::class, 'create'])->name('create');
        Route::put('/contract/{contract}', [ContractController::class, 'update'])->name('update');
        Route::delete('/contract/{contract}', [ContractController::class, 'destroy'])->name('destroy');
        Route::get('/contract/{id}/edit', [ContractController::class, 'edit'])->name('edit');
    });
});
