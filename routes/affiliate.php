<?php

use App\Http\Controllers\Affiliate\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'affiliate', 'prefix' => 'affiliate', 'middleware' => ['auth', 'affiliate', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
