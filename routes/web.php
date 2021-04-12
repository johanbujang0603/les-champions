<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeViewAction;

Route::name('web.')->group(function () {
    /* Home */
    Route::get('/', HomeViewAction::class)->name('index');
    Route::get('/detail/{id}', [HomeViewAction::class, 'detail'])->name('detail');
});
