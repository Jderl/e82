<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/



//login route 
Route::post('/login',[AuthController::class,'login']);
//registration route 
Route::post('/login',[AuthController::class,'Register']);
//Forgot route 
Route::post('/login',[ForgotController::class,'ForgotPassoword']);
//Reset password route 
Route::post('/login',[ResetController::class,'ResetPassword']);


//get user route
//user middleware to check if the user is logged
Route::get('/user',[UserController::class,'User'])->middleware('auth:api');