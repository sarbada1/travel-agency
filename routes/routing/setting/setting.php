<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Setting\SettingController;

Route::get('setting', [SettingController::class, 'index'])->name('setting');
Route::post('setting', [SettingController::class, 'update']);



