<?php

namespace App\Http\Controllers;

use App\Models\Academic\AssessmentAnswer;
use Illuminate\Http\Request;

class AssessmentAnswerController extends Controller
{
    public function index()
    {
        return response()->json(AssessmentAnswer::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'score' => 'nullable|integer',
            'student_answer' => 'nullable|string',
            'submission_id' => 'required|exists:assessment_submissions,submission_id',
            'question_id' => 'required|exists:assessment_questions,question_id'
        ]);

        $answer = AssessmentAnswer::create($validated);

        return response()->json($answer, 201);
    }

    public function show(AssessmentAnswer $answer)
    {
        return response()->json($answer);
    }

    public function update(Request $request, AssessmentAnswer $answer)
    {
        $validated = $request->validate([
            'score' => 'nullable|integer',
            'student_answer' => 'nullable|string',
            'submission_id' => 'nullable|exists:assessment_submissions,submission_id',
            'question_id' => 'nullable|exists:assessment_questions,question_id'
        ]);

        $answer->update($validated);

        return response()->json($answer);
    }

    public function destroy(AssessmentAnswer $answer)
    {
        $answer->delete();

        return response()->json(null, 204);
    }
}
