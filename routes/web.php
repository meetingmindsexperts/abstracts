<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormController;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/submit-form', [FormController::class, 'submitForm'])->name('submit.form');
Route::get('/thank-you/{email}/{paper_number}', [FormController::class, 'thankYou'])->name('thank.you');

Route::get('/admin/videos', [VideoController::class, 'index'])->name('admin.videos.index');
Route::get('/admin/videos/{id}/view', [VideoController::class, 'view'])->name('admin.videos.view');
Route::get('/admin/videos/{id}/download', [VideoController::class, 'download'])->name('admin.videos.download');
Route::get('/admin/videos/export', [VideoController::class, 'export'])->name('admin.videos.export');

// Route::get('/admin/videos/{id}/delete', [VideoController::class, 'delete'])->name('admin.videos.delete');