<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UsertaskController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('persons',[PersonController::class, 'index']);
Route::post('persons',[PersonController::class, 'store']);
Route::get('persons/{id}',[PersonController::class, 'show']);
Route::get('persons/{id}/edit',[PersonController::class, 'edit']);
Route::put('persons/{id}/edit',[PersonController::class, 'update']);
Route::delete('persons/{id}/delete',[PersonController::class, 'destroy']);


Route::get('tasks',[TaskController::class,'index']); 
Route::post('tasks',[TaskController::class, 'store']);
Route::get('tasks/{id}',[TaskController::class, 'show']);
Route::get('tasks/{id}/edit',[TaskController::class, 'edit']);
Route::put('tasks/{id}/edit',[TaskController::class, 'update']);
Route::delete('tasks/{id}/delete',[TaskController::class, 'destroy']);

Route::get('status',[StatusController::class, 'index']);
Route::post('status',[StatusController::class, 'store']);
Route::get('status/{id}',[StatusController::class, 'show']);
Route::delete('status/{id}/delete',[StatusController::class, 'destroy']);

Route::get('usertasks',[UsertaskController::class,'index']); 
Route::post('usertasks',[UsertaskController::class, 'store']);