<?php

namespace App\Http\Controllers;

use App\Models\Profile\TeacherDetail;
use Illuminate\Http\Request;

class TeacherDetailController extends Controller
{
    public function index()
    {
        return response()->json(TeacherDetail::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'position' => 'required|string',
            'specialization' => 'nullable|string',
            'user_id' => 'required|exists:users,user_id'
        ]);

        $teacher = TeacherDetail::create($validated);

        return response()->json($teacher, 201);
    }

    public function show(TeacherDetail $teacher)
    {
        return response()->json($teacher);
    }

    public function update(Request $request, TeacherDetail $teacher)
    {
        $validated = $request->validate([
            'position' => 'nullable|string',
            'specialization' => 'nullable|string',
            'user_id' => 'nullable|exists:users,user_id'
        ]);

        $teacher->update($validated);

        return response()->json($teacher);
    }

    public function destroy(TeacherDetail $teacher)
    {
        $teacher->delete();

        return response()->json(null, 204);
    }
}
