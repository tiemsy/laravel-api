<?php

namespace App\Http\Controllers;

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
        $tasks = Task::orderByDesc('created_at')->get();

        return response([
            'tasks' => resourceTask::collection($tasks),
            'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('api.tasks.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if (Task::create($request->all())) {
            return response()->json([
                'success' => "Task has been created with success"
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
    public function update(Request $request, Task $task)
    {
        if ($task->update($request->all())) {
            return response()->json([
                'success' => "Task has been updated with success"
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
                'success' => "Task has been delated with success"
            ], 200);
        }

    }

}
