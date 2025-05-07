<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TourPackage\TourPackageController;
use App\Http\Controllers\Backend\PackageAttribute\PackageAttributeController;




Route::resource('manage-tour-package', "\App\Http\Controllers\Backend\TourPackage\TourPackageController");

// Add these routes inside your Route group
Route::post('get-category-fields', [TourPackageController::class, 'getCategoryFields'])->name('get-category-fields');
Route::post('get-category-attributes', [TourPackageController::class, 'getCategoryAttributes'])->name('get-category-attributes');
Route::get('search-attributes', [PackageAttributeController::class, 'searchAttributes'])->name('search-attributes');
Route::post('create-attribute', [PackageAttributeController::class, 'createAttributeAjax'])->name('create-attribute');
Route::get('get-attribute-info/{id}', [PackageAttributeController::class, 'getAttributeInfo'])->name('get-attribute-info');

Route::get('/get-package-attributes/{id}', [TourPackageController::class, 'getPackageAttributes'])->name('get-package-attributes');