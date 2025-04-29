<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Account\AccountType\AccountTypeController;


Route::get('manage-account-type', [AccountTypeController::class, 'index'])->name('manage-account-type');
Route::get('manage-account-type/all-account-type', [AccountTypeController::class, 'allAccountType'])->name('manage-account-type.all-account-type');
Route::post('manage-account-type/store', [AccountTypeController::class, 'store'])->name('manage-account-type.store');
Route::post('manage-account-type/delete', [AccountTypeController::class, 'delete'])->name('manage-account-type.delete');
Route::post('manage-account-type/edit', [AccountTypeController::class, 'edit'])->name('manage-account-type.edit');
Route::post('manage-account-type/update', [AccountTypeController::class, 'update'])->name('manage-account-type.update');
