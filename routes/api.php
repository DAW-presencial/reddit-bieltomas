<?php

use App\Http\Controllers\API\ComunidadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ComentarioController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TokenController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('comunidades', ComunidadController::class)->only(['index','show']);
Route::apiResource('comentarios', ComentarioController::class)->only(['index','show']);
Route::apiResource('posts', PostController::class)->only(['index','show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('comunidades', ComunidadController::class)->except(['index','show']);
    Route::apiResource('comentarios', ComentarioController::class)->except(['index','show']);
    Route::apiResource('posts', PostController::class)->except(['index','show']);
});

Route::post('token', [TokenController::class, 'createToken']);

