<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function enrollStudent(Request $request)
    {
        $user = $request->user();
        // 1. Validate the incoming API request data
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,classroom_id',
            // 'user_id' => 'required|exists:users,user_id',
            ]);

        // $user = User::findOrFail($validated['user_id']);

        // 3. Attach the ID to the pivot table with extra attributes if necessary
        $user->enrolledClassrooms()->attach($validated['classroom_id']);

        return response()->json([
            'message' => 'Student successfully enrolled!'
        ], 201);
    }
}
