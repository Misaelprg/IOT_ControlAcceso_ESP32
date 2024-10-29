<?php

use App\Http\Controllers\RecordsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;

Route::get('/', [RecordsController::class, 'index']);
Route::get('/filter', [RecordsController::class, 'filter'])->name('filter');

Route::get('/workers', [WorkerController::class, 'index']);
Route::get('/workers/filter', [WorkerController::class, 'filter'])->name('workersfilter');
Route::get('/worker/data', [WorkerController::class, 'saveFingerPrint'])->name('workerSavePrint');




