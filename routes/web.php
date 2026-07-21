<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Taskcontroller;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessaController;
/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect()->route('login');

});


/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        return match(auth()->user()->role){

            'admin'   => redirect()->route('admin.dashboard'),

            'school'  => redirect()->route('school.dashboard'),

            'student' => redirect()->route('student.dashboard'),

            default   => abort(403),

        };

    })->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');

    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');

    Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get('/dashboard',[AdminController::class,'dashboard'])
        ->name('dashboard');



    /*
    |--------------------------------------------------------------------------
    | School Management
    |--------------------------------------------------------------------------
    */

    Route::get('/schools',[AdminController::class,'schools'])
        ->name('schools.index');

    Route::get('/schools/create',[AdminController::class,'createSchool'])
        ->name('schools.create');

    Route::post('/schools',[AdminController::class,'storeSchool'])
        ->name('schools.store');

    Route::get('/schools/{id}',[AdminController::class,'schoolDetails'])
        ->name('schools.show');

    Route::get('/schools/{id}/edit',[AdminController::class,'editSchool'])
        ->name('schools.edit');

    Route::put('/schools/{id}',[AdminController::class,'updateSchool'])
        ->name('schools.update');

    Route::patch('/schools/{id}/block',[AdminController::class,'blockSchool'])
        ->name('schools.block');

    Route::patch('/schools/{id}/unblock',[AdminController::class,'unblockSchool'])
        ->name('schools.unblock');

    Route::delete('/schools/{id}',[AdminController::class,'deleteSchool'])
        ->name('schools.delete');

});


/*
|--------------------------------------------------------------------------
| School Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('school')
    ->name('school.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [SchoolController::class, 'dashboard'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Student Management
        |--------------------------------------------------------------------------
        */

        Route::get('/students', [SchoolController::class, 'students'])
            ->name('students.index');

        Route::get('/students/create', [SchoolController::class, 'createStudent'])
            ->name('students.create');

        Route::post('/students', [SchoolController::class, 'storeStudent'])
            ->name('students.store');

        Route::get('/students/{id}', [SchoolController::class, 'studentDetails'])
            ->name('students.show');

        Route::get('/students/{id}/edit', [SchoolController::class, 'editStudent'])
            ->name('students.edit');

        Route::put('/students/{id}', [SchoolController::class, 'updateStudent'])
            ->name('students.update');

        Route::patch('/students/{id}/block', [SchoolController::class, 'blockStudent'])
            ->name('students.block');

        Route::patch('/students/{id}/unblock', [SchoolController::class, 'unblockStudent'])
            ->name('students.unblock');

        Route::delete('/students/{id}', [SchoolController::class, 'deleteStudent'])
            ->name('students.delete');




        Route::prefix('tasks')->name('tasks.')->group(function () {

    Route::get('/', [TaskController::class, 'index'])->name('index');

    Route::get('/create', [TaskController::class, 'create'])->name('create');

    Route::post('/', [TaskController::class, 'store'])->name('store');

    Route::get('/{id}', [TaskController::class, 'show'])->name('show');

    Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');

    Route::put('/{id}', [TaskController::class, 'update'])->name('update');

    Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');

});


/*
|--------------------------------------------------------------------------
| Chat
|--------------------------------------------------------------------------
*/

Route::prefix('chat')->name('chat.')->group(function () {

    Route::get('/', [ChatController::class, 'schoolIndex'])
        ->name('index');

    Route::get('/{id}', [ChatController::class, 'open'])
        ->name('open');

    Route::post('/send/{conversation}', [ChatController::class, 'send'])
        ->name('send');

});

    });


/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
->prefix('student')
->name('student.')
->group(function(){

    Route::get('/dashboard',[StudentController::class,'dashboard'])
        ->name('dashboard');
    Route::get('/students', [SchoolController::class, 'students'])
    ->name('students.index');

Route::get('/students/{id}', [SchoolController::class, 'studentDetails'])
    ->name('students.show');

Route::get('/students/{id}/edit', [SchoolController::class, 'editStudent'])
    ->name('students.edit');

Route::put('/students/{id}', [SchoolController::class, 'updateStudent'])
    ->name('students.update');

Route::patch('/students/{id}/block', [SchoolController::class, 'blockStudent'])
    ->name('students.block');

Route::patch('/students/{id}/unblock', [SchoolController::class, 'unblockStudent'])
    ->name('students.unblock');

Route::delete('/students/{id}', [SchoolController::class, 'deleteStudent'])
    ->name('students.delete');


Route::prefix('tasks')->name('tasks.')->group(function () {

    Route::get('/', [TaskController::class, 'myTasks'])->name('index');

    Route::get('/pending', [TaskController::class, 'pendingTasks'])->name('pending');

    Route::get('/completed', [TaskController::class, 'completedTasks'])->name('completed');

    Route::get('/high-priority', [TaskController::class, 'highPriorityTasks'])->name('high');

    Route::get('/{id}', [TaskController::class, 'studentShow'])->name('show');

    Route::patch('/{id}/complete', [TaskController::class, 'complete'])->name('complete');

    Route::patch('/{id}/pending', [TaskController::class, 'pending'])->name('markPending');

});


/*
|--------------------------------------------------------------------------
| Chat
|--------------------------------------------------------------------------
*/

Route::prefix('chat')->name('chat.')->group(function () {

    Route::get('/', [ChatController::class, 'studentIndex'])
        ->name('index');

    Route::get('/{id}', [ChatController::class, 'open'])
        ->name('open');

    Route::post('/send/{conversation}', [ChatController::class, 'send'])
        ->name('send');

});
});


require __DIR__.'/auth.php';