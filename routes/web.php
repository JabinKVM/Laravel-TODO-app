<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);

Route::get('/create', [TaskController::class, 'create']);
Route::post('/store', [TaskController::class, 'store']);

Route::get('/edit/{id}', [TaskController::class, 'edit']);
Route::put('/update/{id}', [TaskController::class, 'update']);

Route::delete('/delete/{id}', [TaskController::class, 'destroy']);

Route::put('/complete/{id}',[TaskController::class,'complete']);