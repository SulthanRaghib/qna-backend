<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin-login', [LoginController::class, 'index'])->name('login');
