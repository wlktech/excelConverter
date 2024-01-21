<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;



Route::get('/', [TestController::class, 'index']);
Route::post('/upload', [TestController::class, 'uploadExcel'])->name('upload');
Route::get('/data', [TestController::class, 'getData'])->name('data');
Route::get('/export', [TestController::class, 'export'])->name('export');