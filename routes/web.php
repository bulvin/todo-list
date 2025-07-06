<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todos/{todo}', [TodoController::class, 'show'])->name('todos.show');
    Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::put('/todos/{id}', [TodoController::class, 'update'])->name('todos.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

});

Route::get('/', function () {
    return auth()->check() ? redirect('/todos') : redirect('/login');
});

