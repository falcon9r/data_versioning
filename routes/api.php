<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\type_2\UserController as T2UserController;
use App\Http\Controllers\type_3\UserController as T3UserController;
use App\Http\Controllers\type_4\UserController as T4UserController;
use App\Http\Controllers\type_6\UserController  as T6UserController;

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
    Route::patch('/user/{id}', [T2UserController::class, 'update']);
});
Route::group(['prefix' => 'type_3'], function(){
    Route::post("user" , [T3UserController::class, 'store']);
    Route::get('/user' , [T3UserController::class , 'index']);
    Route::get('/user/{id}' , [T3UserController::class , 'show']);
    Route::patch('/user/{id}', [T3UserController::class, 'update']);
});
Route::group(['prefix' => 'type_4'], function(){
    Route::post("user" , [T4UserController::class, 'store']);
    Route::get('/user' , [T4UserController::class , 'index']);
    Route::get('/user/{id}' , [T4UserController::class , 'show']);
    Route::patch('/user/{id}', [T4UserController::class, 'update']);
});
Route::group(['prefix' => 'type_6'], function(){
    Route::post("user" , [T6UserController::class, 'store']);
    Route::get('/user' , [T6UserController::class , 'index']);
    Route::get('/user/{id}' , [T6UserController::class , 'show']);
    Route::patch('/user/{id}', [T6UserController::class, 'update']);
});
