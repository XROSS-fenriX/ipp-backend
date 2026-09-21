<?php

namespace App\Http\Controllers;

use App\Models\School\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return response()->json(School::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string',
            'street' => 'required|string',
            'barangay' => 'required|string',
            'municipality' => 'required|string',
            'province' => 'required|string',
            'type' => 'required|string'
        ]);

        $school = School::create($validated);

        return response()->json($school, 201);
    }

    public function show(School $school)
    {
        return response()->json($school);
    }

    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'school_name' => 'nullable|string',
            'street' => 'nullable|string',
            'barangay' => 'nullable|string',
            'municipality' => 'nullable|string',
            'province' => 'nullable|string',
            'type' => 'nullable|string'
        ]);

        $school->update($validated);

        return response()->json($school);
    }

    public function destroy(School $school)
    {
        $school->delete();

        return response()->json(null, 204);
    }
}
