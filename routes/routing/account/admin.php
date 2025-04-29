<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'manage-account'], function () {
    Route::resource('admin', "\App\Http\Controllers\Backend\Account\Admin\AdminController");
});
