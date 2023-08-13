<?php

use App\Http\Controllers\Apis\V1\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group( function () {
    Route::get('/my-task', [TaskController::class, 'index']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::get('/task/{id}', [TaskController::class, 'show']);
    Route::put('/task/{id}', [TaskController::class, 'update']);
    Route::delete('/task/{id}', [TaskController::class, 'destroy']);
});