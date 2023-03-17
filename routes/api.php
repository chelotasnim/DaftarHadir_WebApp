<?php

use App\Http\Controllers\ApiData;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatApi;
use App\Http\Controllers\IzinApi;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/apiRegister', [AuthController::class, 'register']);

Route::post('/apiLogin', [AuthController::class, 'login']);

Route::get('/apiLogout', [AuthController::class, 'logout']);

Route::get('/apiProfile', [ApiData::class, 'profile']);

Route::get('/apiCheckLog', [ApiData::class, 'checkLog']);

Route::get('/apiChat', [ChatApi::class, 'showChat']);

Route::get('/apiChatSession', [ChatApi::class, 'enterChat']);

Route::get('/apiShowIzin', [IzinApi::class, 'showIzin']);