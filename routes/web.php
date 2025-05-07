<?php

use App\Http\Controllers\TodoInfoController;
use Illuminate\Support\Facades\Route;

// Home route: Displays all tasks
Route::get('/', [TodoInfoController::class, 'index'])->name('todo');

// Show form to add a new task
Route::get('/todos/create', [TodoInfoController::class, 'create'])->name('todo.create');

// Store a new task
Route::post('/todos', [TodoInfoController::class, 'store'])->name('todo.store');

// Toggle the 'is_done' checkbox status (for AJAX updates)
Route::patch('/todos/{id}/status', [TodoInfoController::class, 'updateStatus'])->name('todo.updateStatus');

// Show form to edit an existing task
Route::get('/todos/{id}/edit', [TodoInfoController::class, 'edit'])->name('todo.edit');

// Update a task
Route::put('/todos/{id}', [TodoInfoController::class, 'update'])->name('todo.update');

// Delete a task
Route::delete('/todos/{id}', [TodoInfoController::class, 'destroy'])->name('todo.destroy');

Route::get('/create', [TodoInfoController::class, 'create'])->name('create');
Route::put('/todo/update/{id}', [TodoInfoController::class, 'update'])->name('update');
Route::get('/todo', [TodoInfoController::class, 'index'])->name('todo');
Route::post('/todo', [TodoInfoController::class, 'todoinfo'])->name('submiteform');
Route::post('/', [TodoInfoController::class, 'todoinfo']);

