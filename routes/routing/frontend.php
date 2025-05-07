<?php
// filepath: /home/sarbada/Desktop/booking/routes/routing/frontend.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ApplicationController;

// Home page
Route::get('/', '\App\Http\Controllers\Frontend\ApplicationController@index')->name('index');
// Add these routes to your web.php file
Route::get('/destinations', [ApplicationController::class, 'destinations'])->name('destinations');
Route::get('/destination/{slug}', [ApplicationController::class, 'showDestination'])->name('destination.show');

Route::get('/tour-packages', [ApplicationController::class, 'tourPackages'])->name('tour-packages');
Route::get('/tour-package/{slug}', [ApplicationController::class, 'showTourPackage'])->name('tour-package.show');