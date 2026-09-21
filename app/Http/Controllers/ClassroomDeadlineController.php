<?php

namespace App\Http\Controllers;

use App\Models\Academic\ClassroomDeadline;
use Illuminate\Http\Request;

class ClassroomDeadlineController extends Controller
{
    public function index()
    {
        return response()->json(ClassroomDeadline::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cd_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'deadline_type' => 'required|string',
            'deadline_description' => 'nullable|string',
            'deadline_location' => 'nullable|string',
            'classroom_id' => 'required|exists:classrooms,classroom_id'
        ]);

        $cd = ClassroomDeadline::create($validated);

        return response()->json($cd, 201);
    }

    public function show(ClassroomDeadline $cd)
    {
        return response()->json($cd);
    }

    public function update(Request $request, ClassroomDeadline $cd)
    {
        $validated = $request->validate([
            'cd_name' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'deadline_type' => 'nullable|string',
            'deadline_description' => 'nullable|string',
            'deadline_location' => 'nullable|string',
            'classroom_id' => 'nullable|exists:classrooms,classroom_id'
        ]);

        $cd->update($validated);

        return response()->json($cd);
    }

    public function destroy(ClassroomDeadline $cd)
    {
        $cd->delete();

        return response()->json(null, 204);
    }
}
