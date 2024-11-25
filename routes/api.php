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

Route::post('/user/login', [AuthController::class, 'login']);
Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/logout', [AuthController::class, 'logout']);
Route::get('/users', [UserController::class, 'index']);

Route::get('/get_pesan', [PesanController::class, 'index']);
Route::post('/kirim_pesan', [PesanController::class, 'store']);
Route::get('/get_pesan_id/{id}', [PesanController::class, 'show']);
Route::put('/update_pesan/{id}', [PesanController::class, 'update']);
Route::delete('/hapus_pesan/{id}', [PesanController::class, 'destroy']);

Route::get('/get_pesan_jawaban', [JawabanController::class, 'getPesanJawaban']);
Route::post('/kirim_jawaban/{id}', [JawabanController::class, 'sendMessage']);
