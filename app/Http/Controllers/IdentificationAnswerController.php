<?php

namespace App\Http\Controllers;

use App\Models\Academic\IdentificationAnswer;
use Illuminate\Http\Request;

class IdentificationAnswerController extends Controller
{
    public function index()
    {
        return response()->json(IdentificationAnswer::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'correct_answer' => 'required|string',
            'question_id' => 'required|exists:assessment_questions,question_id'
        ]);

        $idAnswer = IdentificationAnswer::create($validated);

        return response()->json($idAnswer, 201);
    }

    public function show(IdentificationAnswer $idAnswer)
    {
        return response()->json($idAnswer);
    }

    public function update(Request $request, IdentificationAnswer $idAnswer)
    {
        $validated = $request->validate([
            'correct_answer' => 'nullable|string',
            'question_id' => 'nullable|exists:assessment_questions,question_id'
        ]);

        $idAnswer->update($validated);

        return response()->json($idAnswer);
    }

    public function destroy(IdentificationAnswer $idAnswer)
    {
        $idAnswer->delete();

        return response()->json(null, 204);
    }
}
