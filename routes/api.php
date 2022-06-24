<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\type_2\UserController as T2UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'type_2'], function(){
    Route::post("user" , [T2UserController::class, 'store']);
    Route::get('/user' , [T2UserController::class , 'index']);
    Route::get('/user/{id}' , [T2UserController::class , 'show']);
});
