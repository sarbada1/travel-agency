<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Faq\FaqController;

Route::resource('manage-faqs', "\App\Http\Controllers\Backend\Faq\FaqController");
Route::get('all-faqs', [FaqController::class, 'allFaqs'])->name('all-faqs');

