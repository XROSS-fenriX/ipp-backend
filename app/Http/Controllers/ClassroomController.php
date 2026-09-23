<?php

namespace App\Http\Controllers;

use App\Models\Academic\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return response()->json(
                Classroom::all()
            );
        }

        if ($user->role === 'teacher' || $user->role === 'student') {
            return response()->json(
                $user->classroom
            );
        }

        return response()->json(['message' => 'Unauthorized access.'], 403);
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

    public function insertAssessment(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'classroom_id' => 'required|exists:classrooms,classroom_id',
            'assessment_id' => 'required|exists:assessments,assessment_id',
            ]);

        // $user = User::findOrFail($validated['user_id']);

        // 3. Attach the ID to the pivot table with extra attributes if necessary
        $classroom->enrolledClassrooms()->attach($validated['classroom_id']);

        return response()->json([
            'message' => 'Student successfully enrolled!'
        ], 201);
    }

    public function show(Request $request, Classroom $classroom)
    {
        $user = $request->user();
        $classroom->load([
            'classroomMaterials',
            'classroomAnnouncements',
            'classroomDeadlines',
            'assessments'
        ]);

        if ($user->role === 'admin') {
            return response()->json($classroom);
        }

        if (
            ($user->role === 'teacher' && $classroom->teacher_id === $user->user_id) ||
            ($user->role === 'student' && $classroom->classroom_id === $user->classroom_id)
        ) {
            return response()->json($classroom);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
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
