<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;


Route::get('/students', [StudentController::class, 'get']);
Route::get('/students/{id}', [StudentController::class, 'getsingle']);
Route::post('/students', [StudentController::class, 'post']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::patch('/students/{id}', [StudentController::class, 'patch']);
Route::delete('/students', [StudentController::class, 'destroyAll']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);