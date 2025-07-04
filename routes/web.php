<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::get('todos/{id}', [TodoController::class, 'show'])->name('todos.show');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
