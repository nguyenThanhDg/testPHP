<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('student', [\App\Http\Controllers\StudentController::class, 'index']);
Route::post('student', [\App\Http\Controllers\StudentController::class, 'store']);
Route::delete('student/{id}', [\App\Http\Controllers\StudentController::class, 'destroy']);
Route::resource('class', \App\Http\Controllers\ClassController::class);
Route::resource('gender', \App\Http\Controllers\GenderController::class);
