<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Tasklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Tasklist $tasklist)
    {
        if (Auth::id() !== $tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($tasklist->tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Tasklist $tasklist)
    {
        if (Auth::id() !== $tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority_id' => 'required|integer',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        if ($request->start_date > $request->due_date) {
            return response()->json(['message' => 'Start date must be before due date'], 400);
        }

        $task = new Task();

        //fields that are not in the form
        $task->tasklist_id = $tasklist->id;

        //fields that are in the form
        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority_id = $request->priority_id;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;

        $task->save();

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasklist $tasklist, Task $task)
    {
        if (Auth::id() !== $task->tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasklist $tasklist, Task $task)
    {
        if (Auth::id() !== $task->tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority_id' => 'required|integer',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        if ($request->start_date > $request->due_date) {
            return response()->json(['message' => 'Start date must be before due date'], 400);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->priority_id = $request->priority_id;
        $task->start_date = $request->start_date;
        $task->due_date = $request->due_date;
        $task->save();

        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasklist $tasklist, Task $task)
    {
        if (Auth::id() !== $task->tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json($task, 200);
    }
}
