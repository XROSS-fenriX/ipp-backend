<?php

namespace App\Http\Controllers;

use App\Models\Academic\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        return response()->json(Assessment::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'assessment_title' => 'required|string',
            'assessment_type' => 'required|string'
        ]);

        $assessment = Assessment::create($validated);

        return response()->json($assessment, 201);
    }

    public function show(Assessment $assessment)
    {
        return response()->json($assessment);
    }

    public function update(Request $request, Assessment $assessment)
    {
        $validated = $request->validate([
            'assessment_title' => 'nullable|string',
            'assessment_type' => 'nullable|string'
        ]);

        $assessment->update($validated);

        return response()->json($assessment);
    }

    public function destroy(Assessment $assessment)
    {
        $assessment->delete();

        return response()->json(null, 204);
    }
}
