<?php

use Illuminate\Support\Facades\Route;


Route::any('user-profile', "\App\Http\Controllers\Backend\Profile\ProfileUpdateController@profile")->name('user-profile');
Route::get('change-password', "\App\Http\Controllers\Backend\Profile\ProfileUpdateController@change_password")->name('change-password');
Route::post('change-password', "\App\Http\Controllers\Backend\Profile\ProfileUpdateController@update_password");
Route::any('update-profile', "\\App\\Http\\Controllers\\Backend\\Profile\ProfileUpdateController@updateProfile")->name('update-profile');
