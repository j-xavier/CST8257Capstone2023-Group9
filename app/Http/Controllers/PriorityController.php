<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    public function index()
    {
        return response()->json(Priority::all(), 200);
    }

    public function show(Priority $priority)
    {
        return response()->json($priority, 200);
    }
}
