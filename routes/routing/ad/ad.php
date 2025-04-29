<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Ad\CampaignController;

Route::resource('manage-ad', '\App\Http\Controllers\Backend\Ad\AdController');
Route::resource('manage-ad-placement', "\App\Http\Controllers\Backend\Ad\AdPlacementController");
Route::resource('manage-ad-position', "\App\Http\Controllers\Backend\Ad\AdPositionController");
Route::get('/admin/ad-manager', [App\Http\Controllers\Backend\Dashboard\DashboardController::class, 'adManagerDashboard'])->name('ad-manager.dashboard');


Route::resource('manage-campaign', "\App\Http\Controllers\Backend\Ad\CampaignController");

Route::resource('manage-adset', "\App\Http\Controllers\Backend\Ad\AdSetController");