<?php

namespace App\Http\Controllers;

use App\Models\Academic\AssessmentQuestion;
use Illuminate\Http\Request;

class AssessmentQuestionController extends Controller
{
    public function index()
    {
        return response()->json(AssessmentQuestion::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'question_type' => 'required|string',
            'points' => 'required|integer',
            'assessment_id' => 'required|exists:assessments,assessment_id'
        ]);

        $question = AssessmentQuestion::create($validated);

        return response()->json($question, 201);
    }

    public function show(AssessmentQuestion $question)
    {
        return response()->json($question);
    }

    public function update(Request $request, AssessmentQuestion $question)
    {
        $validated = $request->validate([
            'question' => 'nullable|string',
            'question_type' => 'nullable|string',
            'points' => 'nullable|integer',
            'assessment_id' => 'nullable|exists:assessments,assessment_id'
        ]);

        $question->update($validated);

        return response()->json($question);
    }

    public function destroy(AssessmentQuestion $question)
    {
        $question->delete();

        return response()->json(null, 204);
    }
}
