<?php

namespace App\Http\Controllers;

use App\Models\Profile\StudentDetail;
use Illuminate\Http\Request;

class StudentDetailController extends Controller
{
    public function index()
    {
        return response()->json(StudentDetail::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'guardian_contact' => 'nullable|string',
            'grade_level' => 'required|string',
            'strand' => 'nullable|string',
            'user_id' => 'required|exists:users,user_id'
        ]);

        $student = StudentDetail::create($validated);

        return response()->json($student, 201);
    }

    public function show(StudentDetail $student)
    {
        return response()->json($student);
    }

    public function update(Request $request, StudentDetail $student)
    {
        $validated = $request->validate([
            'guardian_contact' => 'nullable|string',
            'grade_level' => 'nullable|string',
            'strand' => 'nullable|string',
            'user_id' => 'nullable|exists:users,user_id'
        ]);

        $student->update($validated);

        return response()->json($student);
    }

    public function destroy(StudentDetail $student)
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
