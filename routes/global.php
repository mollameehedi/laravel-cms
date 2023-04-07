<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Global\ProfileController;

Route::group(['prefix' => '/', 'as' => 'global.', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => '/profile', 'as' => 'profile.'], function () {
        Route::get('/', [ProfileController::class, 'profile'])->name('index');
    });
});
