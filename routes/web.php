<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PostbackController;
use App\Http\Controllers\Public\RedirectController;
use App\Http\Controllers\Public\DashboardController;

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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => '/', 'as' => 'public.'], function () {
    Route::get('redirect', [RedirectController::class, 'redirect']);
    Route::get('postback', [PostbackController::class, 'postback']);
    Route::get('cron-jobs', [DashboardController::class, 'topCronJobs'])->name('cron-jobs');
});
