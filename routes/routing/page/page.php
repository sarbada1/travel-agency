<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Page\PageChildController;

Route::resource('manage-page', "\App\Http\Controllers\Backend\Page\PageController");

Route::get('page-child/{pid}/preview', [PageChildController::class, 'index'])->name('page-child');
Route::get('create-page-child/{pid}/create', [PageChildController::class, 'create'])->name('create-page-child');
Route::post('create-page-child/{pid}/create', [PageChildController::class, 'store']);
Route::get('edit-page-child/{pid}/edit', [PageChildController::class, 'edit'])->name('edit-page-child');
Route::put('edit-page-child/{pid}/edit', [PageChildController::class, 'update']);
Route::delete('delete-page-child/{pid}/delete', [PageChildController::class, 'destroy'])->name('delete-page-child');
Route::any('page-faq/{id}', "\App\Http\Controllers\Backend\Page\PageController@pageFaq")->name('page-faq');
