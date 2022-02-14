<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['prefix'=>'users'], function() {
    Route::get('/', [UsersController::class, 'index']);
    Route::post('/', [UsersController::class, 'store']);
    Route::get('/{id}', [UsersController::class, 'show']);
    Route::delete('/{id}', [UsersController::class, 'destroy']);
    Route::put('/{id}', [UsersController::class, 'update']);
});
