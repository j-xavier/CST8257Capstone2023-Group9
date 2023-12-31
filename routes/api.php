<?php

use App\Http\Controllers\TasklistController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PriorityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    // any route in here is protected by sanctum
    Route::apiResource('tasklists', TasklistController::class);
    Route::apiResource('tasklists.tasks', TaskController::class);
});

Route::apiResource('priorities', PriorityController::class)->only(['index', 'show']);
