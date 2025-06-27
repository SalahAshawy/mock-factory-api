<?php

use App\Http\Controllers\Api\MockProjectController;
use App\Http\Controllers\Api\MockEndpointController;
use App\Http\Controllers\Api\ServeMockController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/projects', [MockProjectController::class, 'store']);
    Route::get('/projects', [MockProjectController::class, 'index']);
    Route::post('/projects/{project}/endpoints', [MockEndpointController::class, 'store']);
});

//Auh
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);



Route::any('/mock/{token}/{path}', ServeMockController::class)
    ->where('path', '.*');
