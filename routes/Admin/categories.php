<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Http\Request;

Route::group(['prefix'=>'category'], function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'show']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
    Route::put('/{id}', [CategoryController::class, 'update']);
    Route::put('/changeStatues/{id}', [CategoryController::class, 'changeStatues']);
});