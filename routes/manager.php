<?php

use App\Http\Controllers\Manager\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'manager', 'prefix' => 'manager', 'middleware' => ['auth', 'manager', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
