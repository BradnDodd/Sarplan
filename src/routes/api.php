<?php

use App\Http\Controllers\Api\CalloutApiController;
use App\Http\Controllers\Api\TeamApiController;
use App\Http\Controllers\Api\User\UserContactMethodApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('team', TeamApiController::class);
Route::apiResource('callout', CalloutApiController::class);
Route::apiResource('user/contactMethod', UserContactMethodApiController::class);
