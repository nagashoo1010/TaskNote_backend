<?php

use App\Http\Controllers\Api\TaskController;
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

Route::get('/tasks', [TaskController::class,'index'])->name('index');
Route::get('/tasks/{id}', [TaskController::class,'show'])->name('show');
Route::post('tasks', [TaskController::class,'store'])->name('store');
Route::put('/tasks/{id}', [TaskController::class,'update'])->name('update');
Route::delete('/tasks/{id}', [TaskController::class,'destroy'])->name('destroy');