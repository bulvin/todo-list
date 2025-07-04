<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::get('todos/{id}', [TodoController::class, 'edit'])->name('todos.show');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');
