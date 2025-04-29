<?php

use App\Http\Controllers\Backend\News\NewsDetailController;
use Illuminate\Support\Facades\Route;
Route::resource('manage-news', "\App\Http\Controllers\Backend\News\NewsController");
Route::resource('manage-news-category',"\App\Http\Controllers\Backend\News\NewsCategoryController");
Route::resource('manage-news-details',"\App\Http\Controllers\Backend\News\NewsDetailController");
Route::post('manage-news-details/update-order', [NewsDetailController::class, 'updateOrder'])->name('manage-news-details.update-order');