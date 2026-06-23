<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [TaskController::class, 'index'])
        ->name('dashboard');

    // Create Task
    Route::get('/create', [TaskController::class, 'create'])
        ->name('create-task');

    Route::post('/store', [TaskController::class, 'store'])
        ->name('store-task');

    // Edit Task
    Route::get('/edit/{id}', [TaskController::class, 'edit'])
        ->name('edit-task');

    Route::put('/update/{id}', [TaskController::class, 'update'])
        ->name('update-task');

    // Complete Task
    Route::put('/complete/{id}', [TaskController::class, 'complete'])
        ->name('complete-task');

    // Delete Task
    Route::delete('/delete/{id}', [TaskController::class, 'destroy'])
        ->name('delete-task');

    // Pending Tasks
    Route::get('/pending', [TaskController::class, 'pending'])
        ->name('pending');

    // Completed Tasks
    Route::get('/completed', [TaskController::class, 'completed'])
        ->name('completed');

    // High Priority Tasks
    Route::get('/high-priority', [TaskController::class, 'highPriority'])
        ->name('high-priority');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';