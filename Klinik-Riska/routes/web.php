<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;


Route::get('preview-invoice/{id}',[KasirController::class, 'preview'])->name('preview-invoice');
Route::get('download-invoice/{id}',[KasirController::class, 'download'])->name('download-invoice');

Route::get('/', function () {
    return view('welcome');
});
