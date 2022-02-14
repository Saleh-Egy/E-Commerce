<?php

use App\Http\Controllers\Admin\ExceptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['prefix'=>'exceptions'], function() {
    Route::get('/', [ExceptionController::class, 'index']);
    Route::post('/', [ExceptionController::class, 'store']);
    Route::get('/{id}', [ExceptionController::class, 'show']);
    Route::delete('/{id}', [ExceptionController::class, 'destroy']);
    Route::put('/{id}', [ExceptionController::class, 'update']);
});