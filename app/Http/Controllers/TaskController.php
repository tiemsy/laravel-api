<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\Task as resourceTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tasks = Task::with('user')->orderByDesc('created_at')->get();
        return response([
            'tasks' => resourceTask::collection($tasks),
            'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TaskStoreRequest $request)
    {
        if (Task::create($request->all())) {
            return response()->json([
                'success' => true,
                'message' => "Task has been created with success"
            ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Task $task
     * @return resourceTask
     */
    public function show(Task $task)
    {
        return new resourceTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        if ($task->update($request->all())) {
            return response()->json([
                'success' => true,
                'message' => "Task has been updated with success"
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        if ($task->delete()) {
            return response()->json([
                'success' => true,
                'message' => "Task has been delated with success"
            ], 200);
        }

    }

}
