<?php

use Illuminate\Support\Facades\Route;

Route::resource('manage-blog', "\App\Http\Controllers\Backend\Blogs\BlogController");
