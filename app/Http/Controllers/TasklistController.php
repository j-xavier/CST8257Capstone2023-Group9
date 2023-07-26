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
    public function index(User $user)
    {

        if (Auth::id() !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return response()->json($user->tasklists, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tasklist = new Tasklist();
        $tasklist->title = $request->title;
        $tasklist->user_id = Auth::id();
        $tasklist->color = $request->color;
        $tasklist->save();

        return response()->json($tasklist, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Tasklist $tasklist)
    {
        dd($user->toArray(), $tasklist->toArray());
        return response()->json($tasklist, 200);
        /*if (Auth::id() !== $tasklist->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($tasklist, 200);*/
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasklist $tasklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasklist $tasklist)
    {
        //
    }
}
