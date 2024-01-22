<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;




Route::get('/', [DataController::class, 'index']);
Route::post('/upload', [DataController::class, 'uploadExcel'])->name('upload');
Route::get('/export', [DataController::class, 'export'])->name('export');
Route::post('/bulk-delete', [DataController::class, 'bulkDelete'])->name('bulk-delete');