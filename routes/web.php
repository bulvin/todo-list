<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store')
        ->middleware('can:create,App\Models\Todo');
    Route::get('/todos/{todo}', [TodoController::class, 'show'])->name('todos.show')
        ->middleware('can:view,todo');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy')
        ->middleware('can:delete,todo');
    Route::put('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update')
        ->middleware('can:update,todo');

    Route::post('/todos/{todo}/share', [TodoController::class, 'generatePublicLink'])->name('todos.shareLink');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/{token}', [TodoController::class, 'showPublicTodo'])->name('todos.public.show');

Route::get('/', function () {
    return auth()->check() ? redirect('/todos') : redirect('/login');
});

