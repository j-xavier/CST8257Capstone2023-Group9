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
        return response()->json($user->taskLists, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tasklist $tasklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasklist $tasklist)
    {
        //
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
