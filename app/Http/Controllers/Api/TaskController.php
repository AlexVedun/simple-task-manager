<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskWithTagsResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewTaskRequest $request
     * @return TaskWithTagsResource
     */
    public function store(NewTaskRequest $request)
    {
        try {
            $task = Task::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ]);
            if ($request->has('tags_id')) {
                $task->tags()->sync($request->get('tags_id'));
            }
            $task->refresh();

            return TaskWithTagsResource::make($task);
        } catch (\Throwable $exception) {
            return response()->json([
                'Status' => 'Error',
                'Message' => 'Error when creating new task!',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return TaskWithTagsResource
     */
    public function show(Task $task)
    {
        return TaskWithTagsResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
