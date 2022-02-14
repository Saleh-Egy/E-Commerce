<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['prefix'=>'category'], function() {
    Route::get('/', [AdminController::class, 'index']);
    Route::post('/', [AdminController::class, 'store']);
    Route::get('/{id}', [AdminController::class, 'show']);
    Route::delete('/{id}', [AdminController::class, 'destroy']);
    Route::put('/{id}', [AdminController::class, 'update']);
});