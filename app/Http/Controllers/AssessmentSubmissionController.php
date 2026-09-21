<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Academic\AssessmentSubmission;
use Illuminate\Http\Request;

class AssessmentSubmissionController extends Controller
{
    public function index()
    {
        return response()->json(AssessmentSubmission::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'score' => 'nullable|integer',
            'assessment_id' => 'required|exists:assessments,assessment_id',
            'student_lrn' => 'required|exists:student_details,student_lrn'
        ]);

        $submission = AssessmentSubmission::create($validated);

        return response()->json($submission, 201);
    }

    public function show(AssessmentSubmission $submission)
    {
        return response()->json($submission);
    }

    public function update(Request $request, AssessmentSubmission $submission)
    {
        $validated = $request->validate([
            'score' => 'nullable|integer',
            'assessment_id' => 'nullable|exists:assessments,assessment_id',
            'student_lrn' => 'nullable|exists:student_details,student_lrn'
        ]);

        $submission->update($validated);

        return response()->json($submission);
    }

    public function destroy(AssessmentSubmission $submission)
    {
        $submission->delete();

        return response()->json(null, 204);
    }
}
