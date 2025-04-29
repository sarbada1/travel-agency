<?php
// filepath: /home/sarbada/Desktop/booking/routes/routing/frontend.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ItemController;

use App\Http\Controllers\Frontend\RealEstateController;
use App\Http\Controllers\Frontend\ApplicationController;
use App\Http\Controllers\Backend\Seller\SellerController;
use App\Http\Controllers\Frontend\CategoryPageController;

// Home page
Route::get('/', '\App\Http\Controllers\Frontend\ApplicationController@index')->name('index');
