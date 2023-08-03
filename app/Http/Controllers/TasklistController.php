<?php

namespace App\Http\Controllers;

use App\Models\Tasklist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $tasklists = Tasklist::withCount('tasks')->where('user_id', $user->id)->get();

        return response()->json($tasklists, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tasklist = new Tasklist();

        //fields that are not in the form
        $tasklist->user_id = Auth::id();

        //fields that are in the form
        $tasklist->title = $request->title;
        $tasklist->color = $request->color;

        $tasklist->save();

        return response()->json($tasklist, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasklist $tasklist)
    {
        if (Auth::id() !== $tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // load tasklist with all tasks, and add priority name using priority id in the task
        $tasklist->load('tasks');
       
        $tasklist->tasks->each(function ($task) {
            $task->priority_name = $task->priority->priority;
        });
        

        return response()->json($tasklist, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasklist $tasklist)
    {
        if (Auth::id() !== $tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $tasklist->title = $request->title;
        $tasklist->color = $request->color;
        $tasklist->save();

        return response()->json($tasklist, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasklist $tasklist)
    {
        if (Auth::id() !== $tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // delete all tasks in the tasklist to avoid referential integrity errors
        $tasklist->tasks()->delete();

        $tasklist->delete();

        return response()->json($tasklist, 200);
    }
}
