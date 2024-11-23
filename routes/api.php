<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JawabanController;
use App\Http\Controllers\Api\PesanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::apiResource('/users', UserController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/users', [UserController::class, 'index']);

Route::get('/pesan', [PesanController::class, 'index']);
Route::post('/pesan', [PesanController::class, 'store']);
Route::get('/pesan/{id}', [PesanController::class, 'show']);
Route::put('/pesan/{id}', [PesanController::class, 'update']);
Route::delete('/pesan/{id}', [PesanController::class, 'destroy']);

Route::get('/jawaban', [JawabanController::class, 'getPesanJawaban']);
Route::post('/jawaban/{id}', [JawabanController::class, 'sendMessage']);
