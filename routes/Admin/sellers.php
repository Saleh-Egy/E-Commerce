<?php

use App\Http\Controllers\Admin\SellerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::group(['prefix'=>'sellers'], function() {
    Route::get('/', [SellerController::class, 'index']);
    Route::post('/', [SellerController::class, 'store']);
    Route::get('/{id}', [SellerController::class, 'show']);
    Route::delete('/{id}', [SellerController::class, 'destroy']);
    Route::put('/{id}', [SellerController::class, 'update']);
});