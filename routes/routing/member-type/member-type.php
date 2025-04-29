<?php

use App\Http\Controllers\Backend\MemberType\MemberTypeController;
use Illuminate\Support\Facades\Route;


Route::get('manage-member-type', [MemberTypeController::class, 'index'])->name('manage-member-type');
Route::get('manage-member-type/all-member', [MemberTypeController::class, 'allMemberType'])->name('manage-member-type.all-member');
Route::post('manage-member-type/store', [MemberTypeController::class, 'store'])->name('manage-member-type.store');
Route::post('manage-member-type/delete', [MemberTypeController::class, 'delete'])->name('manage-member-type.delete');
Route::post('manage-member-type/edit', [MemberTypeController::class, 'edit'])->name('manage-member-type.edit');
Route::post('manage-member-type/update', [MemberTypeController::class, 'update'])->name('manage-member-type.update');
