<?php

use App\Http\Controllers\Admin\AdvertiserController;
use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DomainController;
use App\Http\Controllers\Admin\ManagerController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Advertiser Route
    Route::resource('advertiser', AdvertiserController::class);
    Route::post('advertiser/search', [AdvertiserController::class, 'search'])->name('advertiser.search');
    Route::post('advertiser/active', [AdvertiserController::class, 'active'])->name('advertiser.active');
    Route::post('advertiser/bulk-action', [AdvertiserController::class, 'bulkAction'])->name('advertiser.bulk-action');

    // Manager Route
    Route::resource('manager', ManagerController::class);
    Route::post('manager/search', [ManagerController::class, 'search'])->name('manager.search');
    Route::post('manager/active', [ManagerController::class, 'active'])->name('manager.active');
    Route::post('manager/bulk-action', [ManagerController::class, 'bulkAction'])->name('manager.bulk-action');

    // Domain Route
    Route::resource('domain', DomainController::class);
    Route::post('domain/search', [DomainController::class, 'search'])->name('domain.search');
    Route::post('domain/active', [DomainController::class, 'active'])->name('domain.active');

    // Category Route
    Route::resource('category', CategoryController::class);
    Route::post('category/search', [CategoryController::class, 'search'])->name('category.search');
    Route::post('category/active', [CategoryController::class, 'active'])->name('category.active');


    // Affiliate Route
    Route::resource('affiliate', AffiliateController::class);
    Route::post('affiliate/search', [AffiliateController::class, 'search'])->name('affiliate.search');
    Route::post('affiliate/active', [AffiliateController::class, 'active'])->name('affiliate.active');
    Route::get('affiliate/login/{id}', [AffiliateController::class, 'login'])->name('affiliate.login');
    Route::post('affiliate/bulk-action', [AffiliateController::class, 'bulkAction'])->name('affiliate.bulk-action');


    // Offer Route
    Route::resource('offer', OfferController::class);
    Route::get('clone/{offer}', [OfferController::class, 'clone'])->name('offer.clone');
    Route::post('offer/search', [OfferController::class, 'search'])->name('offer.search');
    Route::post('offer/bulk-action', [OfferController::class, 'bulkAction'])->name('offer.bulk-action');
    Route::get('offer/payout/{offer}', [OfferController::class, 'payout'])->name('offer.payout');
    Route::get('offer/permission/{offer}', [OfferController::class, 'permission'])->name('offer.permission');
    Route::post('offer/approved', [OfferController::class, 'approved'])->name('offer.approved');
    Route::post('offer/countryPayoutStore/{offer}', [OfferController::class, 'countryPayoutStore'])->name('offer.countryPayoutStore');
    Route::get('offer/countryPayoutDelete/{payout}', [OfferController::class, 'countryPayoutDelete'])->name('offer.countryPayoutDelete');
    Route::post('offer/customPayoutStore/{offer}', [OfferController::class, 'customPayoutStore'])->name('offer.customPayoutStore');
    Route::get('offer/customPayoutDelete/{CustomPayout}', [OfferController::class, 'customPayoutStoreDelete'])->name('offer.customPayoutStoreDelete');
    Route::get('offer/advance/{offer}', [OfferController::class, 'advance'])->name('offer.advance');
    Route::post('offer/capStore/{offer}', [OfferController::class, 'capStore'])->name('offer.capStore');
    Route::get('offer/capDelete/{cap}', [OfferController::class, 'capDelete'])->name('offer.capDelete');
    Route::post('offer/optimizeStore/{offer}', [OfferController::class, 'optimizeStore'])->name('offer.optimizeStore');
    Route::get('offer/optimizeDelete/{optimize}', [OfferController::class, 'optimizeDelete'])->name('offer.optimizeDelete');
    Route::group(['as' => 'profile.', 'prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
        Route::put('/update/password', [ProfileController::class, 'password'])->name('password');
    });
});
