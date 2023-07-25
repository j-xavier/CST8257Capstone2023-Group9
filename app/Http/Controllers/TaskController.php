<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return response()->json($tasks, 200);
    }

    /**
     * Show the form for creating a new resource.
      */
    // public function create()
    // {
        
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $task = new Task();
        $task->tasklist_id = request('tasklist_id');
        $task->title = request('title');
        $task->description = request('description');
        $task->priority_id = request('priority_id');
        $task->view_order = request('view_order');
        $task->start_date = request('start_date');
        $task->due_date = request('due_date');
        $task->save();

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Task $task)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
