<?php

use App\Http\Controllers\AwbPdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/awb/preview', [AwbPdfController::class, 'preview'])->name('awb.pdf.preview');
Route::get('/awb/pdf', [AwbPdfController::class, 'download'])->name('awb.pdf.download');
