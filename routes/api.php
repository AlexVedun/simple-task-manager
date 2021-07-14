<?php

use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TaskController;
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

// GET 'tags'           - get all tags
// GET 'tags/{tag_id}'  - get tag with id={tag_id}
// POST 'tags'          - create new tag
Route::apiResource('tags', TagController::class)
    ->only(['index', 'show', 'store'])
    ->missing(function () {
        return response()->json([
            'Status' => 'Error',
            'Message' => 'Tag not found!',
        ], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

// GET 'tasks'           - get all tasks
// GET 'tasks/{task_id}' - get task with id = {task_id}
// POST 'tasks'          - create new task
Route::apiResource('tasks', TaskController::class)
    ->only(['index', 'show', 'store'])
    ->missing(function () {
        return response()->json([
            'Status' => 'Error',
            'Message' => 'Task not found!',
        ], \Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

