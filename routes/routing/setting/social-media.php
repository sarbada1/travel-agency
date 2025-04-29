<?php

use Illuminate\Support\Facades\Route;
Route::resource('manage-social-media',"\App\Http\Controllers\Backend\Setting\SocialMediaController");
Route::post('manage-social-media-update-status',"\App\Http\Controllers\Backend\Setting\SocialMediaController@updateStatus")->name('manage-social-media-update-status');
