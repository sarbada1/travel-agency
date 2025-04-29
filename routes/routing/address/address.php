<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Address\CountryPageController;
use App\Http\Controllers\Backend\Country\CountryContentController;


Route::group(['prefix' => 'manage-address'], function () {
    Route::resource("continents", "\App\Http\Controllers\Backend\Address\ContinentController");
    Route::resource("countries", "\App\Http\Controllers\Backend\Address\CountryController");
    Route::any('manage-location/{country_id}/index', '\App\Http\Controllers\Backend\Address\CountryController@countryIndex')->name('manage-location');
    Route::any('manage-location-add/{id}/insert', '\App\Http\Controllers\Backend\Address\CountryController@addLocation')->name('manage-location-add');
    Route::any('manage-location-edit/{id}/edit', '\App\Http\Controllers\Backend\Address\CountryController@editLocation')->name('manage-location-edit');
    Route::any('manage-location-update/{id}/update', '\App\Http\Controllers\Backend\Address\CountryController@updateLocation')->name('manage-location-update');
    Route::any('manage-location-delete/{id}/delete', '\App\Http\Controllers\Backend\Address\CountryController@deleteLocation')->name('manage-location-delete');

    Route::get('country-page/{pid}/preview', [CountryPageController::class, 'index'])->name('country-page');
    Route::get('country-page-create/{pid}/create', [CountryPageController::class, 'create'])->name('country-page-create');
    Route::post('country-page-create/{pid}/create', [CountryPageController::class, 'store']);
    Route::get('edit-country-page/{pid}/edit', [CountryPageController::class, 'edit'])->name('edit-country-page');
    Route::put('edit-country-page/{pid}/edit', [CountryPageController::class, 'update']);
    Route::delete('delete-country-page/{pid}/delete', [CountryPageController::class, 'destroy'])->name('delete-country-page');

    Route::any('country-faq/{id}', "\App\Http\Controllers\Backend\Address\CountryController@countryFaq")->name('country-faq');

    Route::get('country-content/{pid}/index', [CountryContentController::class, 'index'])->name('country-content');
    Route::get('country-content-create/{pid}/create', [CountryContentController::class, 'create'])->name('country-content-create');
    Route::post('country-content-create/{pid}/create', [CountryContentController::class, 'store']);
    Route::get('country-content-edit/{id}', [CountryContentController::class, 'edit'])->name('country-content-edit');
    Route::put('country-content-update/{id}', [CountryContentController::class, 'update'])->name('country-content-update');
    Route::delete('country-content-delete/{id}', [CountryContentController::class, 'destroy'])->name('country-content-delete');


});
