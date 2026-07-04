<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [TaskController::class, 'dashboard'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Task Management
    |--------------------------------------------------------------------------
    */

    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    Route::get('/tasks/create', [TaskController::class, 'create'])
        ->name('tasks.create');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    

    Route::put('/tasks/{id}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');

    Route::patch('/tasks/{id}/complete', [TaskController::class, 'complete'])
        ->name('tasks.complete');

    Route::put('/tasks/{task}/inline-update', [TaskController::class, 'inlineUpdate'])
        ->name('tasks.inline-update');

    Route::delete('/tasks/{task}/ajax-delete', [TaskController::class, 'ajaxDelete'])
        ->name('tasks.ajax-delete');

    Route::get('/tasks/pending', [TaskController::class, 'pending'])
        ->name('tasks.pending');

    Route::get('/tasks/completed', [TaskController::class, 'completed'])
        ->name('tasks.completed');

    Route::get('/tasks/high-priority', [TaskController::class, 'highPriority'])
        ->name('tasks.high-priority');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware(['blocked', 'admin'])
        ->prefix('admin')
        ->group(function () {

            Route::get('/', [AdminController::class, 'dashboard'])
                ->name('admin.dashboard');

            Route::get('/users', [AdminController::class, 'users'])
                ->name('admin.users');

            Route::get('/users/{user}', [AdminController::class, 'show'])
                ->name('admin.show');

            Route::patch('/users/{user}/block', [AdminController::class, 'block'])
                ->name('admin.block');

            Route::patch('/users/{user}/unblock', [AdminController::class, 'unblock'])
                ->name('admin.unblock');

            Route::delete('/users/{user}', [AdminController::class, 'destroy'])
                ->name('admin.delete');
        });

    /*
    |--------------------------------------------------------------------------
    | Student Management
    |--------------------------------------------------------------------------
    */

             Route::get('/students', [StudentController::class, 'index'])
                ->name('students.index');

            Route::get('/students/create', [StudentController::class, 'create'])
               ->name('students.create');

            Route::post('/students', [StudentController::class, 'store'])
                ->name('students.store');

            Route::get('/students/{student}', [StudentController::class, 'show'])
                ->name('students.show');

            Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
                ->name('students.edit');

            Route::put('/students/{student}', [StudentController::class, 'update'])
                ->name('students.update');

            Route::delete('/students/{student}', [StudentController::class, 'destroy'])
                ->name('students.destroy');
    });

require __DIR__ . '/auth.php';