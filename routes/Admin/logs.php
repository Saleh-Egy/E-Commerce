<?php

use App\Http\Controllers\Admin\LogsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['prefix'=>'logs'], function() {
    Route::get('/', [LogsController::class, 'index']);
    Route::post('/', [LogsController::class, 'store']);
    Route::get('/{id}', [LogsController::class, 'show']);
    Route::delete('/{id}', [LogsController::class, 'destroy']);
    Route::put('/{id}', [LogsController::class, 'update']);
});