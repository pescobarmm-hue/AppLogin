<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// 1. Redirecciona la raíz directamente al formulario de registro
Route::get('/', [UserController::class, 'create']);

// 2. Ruta para mostrar el formulario de registro (URL: 127.0.0.1:8000/register)
Route::get('/register', [UserController::class, 'create'])->name('register');

// 3. Ruta para procesar los datos enviados por el formulario
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// Lista de estudiantes
Route::get('/estudiantes', [UserController::class, 'index'])->name('users.index');



