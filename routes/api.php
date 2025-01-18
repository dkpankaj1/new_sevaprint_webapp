<?php

use App\Http\Controllers\Api\Auth\AuthController;

use App\Http\Controllers\Api\Auth\PasswordResetLinkController;
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/login',[AuthController::class,'store']);
Route::post('/register',[RegisterController::class,'store']);
Route::post('password-reset',[PasswordResetLinkController::class,'store']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout',[AuthController::class,'destroy']);
});

