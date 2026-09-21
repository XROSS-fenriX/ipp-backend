<?php

namespace App\Http\Controllers;

use App\Models\Academic\ClassroomAnnouncement;
use Illuminate\Http\Request;

class ClassroomAnnouncementController extends Controller
{
    public function index()
    {
        return response()->json(ClassroomAnnouncement::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ca_title' => 'required|string',
            'ca_description' => 'nullable|string',
            'file_link' => 'nullable|string',
            'classroom_id' => 'required|exists:classrooms,classroom_id'
        ]);

        $ca = ClassroomAnnouncement::create($validated);

        return response()->json($ca, 201);
    }

    public function show(ClassroomAnnouncement $ca)
    {
        return response()->json($ca);
    }

    public function update(Request $request, ClassroomAnnouncement $ca)
    {
        $validated = $request->validate([
            'ca_title' => 'nullable|string',
            'ca_description' => 'nullable|string',
            'file_link' => 'nullable|string',
            'classroom_id' => 'nullable|exists:classrooms,classroom_id'
        ]);

        $ca->update($validated);

        return response()->json($ca);
    }

    public function destroy(ClassroomAnnouncement $ca)
    {
        $ca->delete();

        return response()->json(null, 204);
    }
}
