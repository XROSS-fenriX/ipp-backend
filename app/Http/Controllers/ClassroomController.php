<?php

namespace App\Http\Controllers;

use App\Models\Academic\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        return response()->json(Classroom::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'classroom_name' => 'required|string',
            'subject_name' => 'required|string',
            'grade_level' => 'required|string',
            'adviser_id' => 'nullable|exists:users,user_id',
            'elective_id' => 'nullable|exists:electives,elective_id'
        ]);

        $classroom = Classroom::create($validated);

        return response()->json($classroom, 201);
    }

    public function show(Classroom $classroom)
    {
        return response()->json($classroom);
    }

    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'classroom_name' => 'nullable|string',
            'subject_name' => 'nullable|string',
            'grade_level' => 'nullable|string',
            'adviser_id' => 'nullable|exists:users,user_id',
            'elective_id' => 'nullable|exists:electives,elective_id'
        ]);

        $classroom->update($validated);

        return response()->json($classroom);
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();

        return response()->json(null, 204);
    }
}
