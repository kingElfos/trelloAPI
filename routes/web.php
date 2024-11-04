<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Mensaje de bienvenida en la raíz
Route::get('/', function () {
    return response()->json([
        "message" => "welcome to api trello made with laravel",
        "status"  => "200",
    ]);
});

// Agrupación de rutas API
Route::group(['prefix' => 'api'], function () {
    // Rutas de autenticación sin protección
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/logout', [AuthController::class, 'logout']);

    // Grupo de rutas protegidas para proyectos y tareas
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('tasks', TaskController::class);
        Route::get('tasks/getTasksByProject/{projectId}', [TaskController::class, 'getTasksByProject']);
    });
});
