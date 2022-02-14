<?php

use App\Events\ExceptionFired;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pusher', function () {
    return view('welcome');
});



Route::get('test', function () {
    $ex = [
        'message' => 'hello world'
    ];
    event(new ExceptionFired($ex));
    return "Event has been sent!";
});