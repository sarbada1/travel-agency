<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Permission\PermissionController;

Route::get('manage-permission', [PermissionController::class, 'index'])->name('manage-permission');
Route::get('manage-permission/all-permission', [PermissionController::class, 'allPermission'])->name('manage-permission.all-permission');
Route::post('manage-permission/store', [PermissionController::class, 'store'])->name('manage-permission.store');
Route::post('manage-permission/delete', [PermissionController::class, 'delete'])->name('manage-permission.delete');
Route::post('manage-permission/edit', [PermissionController::class, 'edit'])->name('manage-permission.edit');
Route::post('manage-permission/update', [PermissionController::class, 'update'])->name('manage-permission.update');
