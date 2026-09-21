<?php

namespace App\Http\Controllers;

use App\Models\Academic\ClassroomMaterial;
use Illuminate\Http\Request;

class ClassroomMaterialController extends Controller
{
    public function index()
    {
        return response()->json(ClassroomMaterial::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'file_link' => 'required|string',
            'description' => 'nullable|string',
            'classroom_id' => 'required|exists:classrooms,classroom_id'
        ]);

        $cm = ClassroomMaterial::create($validated);

        return response()->json($cm, 201);
    }

    public function show(ClassroomMaterial $cm)
    {
        return response()->json($cm);
    }

    public function update(Request $request, ClassroomMaterial $cm)
    {
        $validated = $request->validate([
            'title' => 'nullable|string',
            'file_link' => 'nullable|string',
            'description' => 'nullable|string',
            'classroom_id' => 'nullable|exists:classrooms,classroom_id'
        ]);

        $cm->update($validated);

        return response()->json($cm);
    }

    public function destroy(ClassroomMaterial $cm)
    {
        $cm->delete();

        return response()->json(null, 204);
    }
}
