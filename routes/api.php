<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\InstallationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.v1.')->group(function () {
    Route::post('installations', [InstallationController::class, 'store'])->name('installations.store');
    Route::put('installations/{uuid}', [InstallationController::class, 'update'])->name('installations.update');
    
    Route::middleware(['installation'])->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
    });
});
