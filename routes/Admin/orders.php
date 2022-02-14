<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Http\Request;


Route::group(['prefix'=>'orders'], function() {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/{id}', [OrderController::class, 'show']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);
    Route::put('/{id}', [OrderController::class, 'update']);
});