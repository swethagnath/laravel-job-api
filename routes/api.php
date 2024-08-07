<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// to get a user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// to get Job crud resources
Route::get('/myjobs', [JobController::class, 'myJobs'])->middleware(['auth:sanctum']);
Route::apiResource('/jobs', JobController::class);


// user register crud
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function() {    
    Route::post('/logout',   [AuthController::class, 'logout']);
});
