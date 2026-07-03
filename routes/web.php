<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [TaskController::class, 'dashboard'])
        ->name('dashboard');

    // Tasks
    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])
        ->name('tasks.edit');

    Route::put('/tasks/{id}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])
        ->name('tasks.complete');

    // Pending Tasks
    Route::get('/tasks/pending', [TaskController::class, 'pending'])
        ->name('tasks.pending');

    // Completed Tasks
    Route::get('/tasks/completed', [TaskController::class, 'completed'])
        ->name('tasks.completed');

    // High Priority Tasks
    Route::get('/tasks/high-priority', [TaskController::class, 'highPriority'])
        ->name('tasks.high-priority');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    Route::middleware([
         'auth',
        'blocked',
        'admin'
        ])->prefix('admin')
        ->group(function () {

    Route::get(
        '/',
        [AdminController::class,'dashboard']
    )->name('admin.dashboard');

    Route::get(
        '/users',
        [AdminController::class,'users']
    )->name('admin.users');
    Route::get(
    '/users/{user}',
    [AdminController::class, 'show']
)->name('admin.show');
    Route::patch(
        '/users/{user}/block',
        [AdminController::class,'block']
    )->name('admin.block');

    Route::patch(
        '/users/{user}/unblock',
        [AdminController::class,'unblock']
    )->name('admin.unblock');

    Route::delete(
        '/users/{user}',
        [AdminController::class,'destroy']
    )->name('admin.delete');

});
});

require __DIR__.'/auth.php';