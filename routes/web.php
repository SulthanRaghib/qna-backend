<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\PesanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PesanController::class, 'index'])->name('pesan');
Route::post('/kirim-pesan', [PesanController::class, 'kirim_pesan'])->name('pesan.store');
Route::get('/admin-login', [LoginController::class, 'index'])->name('login');
Route::get('/semua-pesan', [PesanController::class, 'get_semua_pesan'])->name('pesan.all');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/reply', [PesanController::class, 'kirim_reply'])->name('pesan.reply.submit');
Route::put('/update-pesan/{id}', [PesanController::class, 'update'])->name('pesan.update');
Route::delete('/hapus-pesan/{id}', [PesanController::class, 'hapus_pesan'])->name('pesan.delete');
