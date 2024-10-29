<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::apiResource('projects', ProjectController::class);
Route::apiResource('tasks', TaskController::class);

Route::get('/', function () {
    return json_encode(["message" => "welcome to api trello made with laravel", "status" => "200"]);
});
Route::get('getTasksByProject/{projectId}', [TaskController::class, 'getTasksByProject']);

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
