<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')
        ->prefix('admin')
        ->group(function () {

            Route::get('/dashboard', [AdminController::class,'dashboard'])
                ->name('admin.dashboard');

            Route::get('/schools', [AdminController::class,'schools'])
                ->name('schools.index');

            Route::get('/schools/create', [AdminController::class,'createSchool'])
                ->name('schools.create');

            Route::post('/schools', [AdminController::class,'storeSchool'])
                ->name('schools.store');

            Route::get('/schools/{school}', [AdminController::class,'showSchool'])
                ->name('schools.show');

            Route::get('/schools/{school}/edit', [AdminController::class,'editSchool'])
                ->name('schools.edit');

            Route::put('/schools/{school}', [AdminController::class,'updateSchool'])
                ->name('schools.update');

            Route::delete('/schools/{school}', [AdminController::class,'destroySchool'])
                ->name('schools.destroy');

            Route::patch('/schools/{school}/status', [AdminController::class,'toggleSchoolStatus'])
                ->name('schools.status');

        });

    /*
    |--------------------------------------------------------------------------
    | SCHOOL
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:school')
        ->prefix('school')
        ->group(function () {

            Route::get('/dashboard', [SchoolController::class,'dashboard'])
                ->name('school.dashboard');

            /*
            |--------------------------------------------------------------------------
            | STUDENTS
            |--------------------------------------------------------------------------
            */

            Route::get('/students', [SchoolController::class,'students'])
                ->name('school.students');

            Route::get('/students/create', [SchoolController::class,'createStudent'])
                ->name('school.students.create');

            Route::post('/students', [SchoolController::class,'storeStudent'])
                ->name('school.students.store');

            Route::get('/students/{student}', [SchoolController::class,'showStudent'])
                ->name('school.students.show');

            Route::get('/students/{student}/edit', [SchoolController::class,'editStudent'])
                ->name('school.students.edit');

            Route::put('/students/{student}', [SchoolController::class,'updateStudent'])
                ->name('school.students.update');

            Route::delete('/students/{student}', [SchoolController::class,'destroyStudent'])
                ->name('school.students.destroy');

            Route::patch('/students/{student}/status', [SchoolController::class,'toggleStudentStatus'])
                ->name('school.students.status');

            /*
            |--------------------------------------------------------------------------
            | TASKS
            |--------------------------------------------------------------------------
            */

            Route::get('/tasks', [TaskController::class,'index'])
                ->name('school.tasks.index');

            Route::get('/tasks/create', [TaskController::class,'create'])
                ->name('school.tasks.create');

            Route::post('/tasks', [TaskController::class,'store'])
                ->name('school.tasks.store');

            Route::get('/tasks/{id}/edit', [TaskController::class,'edit'])
                ->name('school.tasks.edit');

            Route::put('/tasks/{id}', [TaskController::class,'update'])
                ->name('school.tasks.update');

            Route::delete('/tasks/{id}', [TaskController::class,'destroy'])
                ->name('school.tasks.destroy');

        });

   /*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware('role:student')
    ->prefix('student')
    ->group(function () {

        Route::get('/dashboard', [StudentController::class,'dashboard'])
            ->name('student.dashboard');

        Route::get('/tasks', [TaskController::class,'myTasks'])
            ->name('student.tasks');

        // View Single Task
        Route::get('/tasks/{id}', [TaskController::class,'show'])
            ->name('student.tasks.show');

        // Mark Completed
        Route::patch('/tasks/{id}/complete', [TaskController::class,'complete'])
            ->name('student.tasks.complete');

        // Mark Pending Again
        Route::patch('/tasks/{id}/pending', [TaskController::class,'pending'])
            ->name('student.tasks.pending');

    });
    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class,'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class,'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class,'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';