<?php

namespace App\Http\Controllers;

use App\Models\Academic\EnumerationAnswer;
use Illuminate\Http\Request;

class EnumerationAnswerController extends Controller
{
    public function index()
    {
        return response()->json(EnumerationAnswer::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'answer' => 'required|string',
            'question_id' => 'required|exists:assessment_questions,question_id'
        ]);

        $idAnswer = EnumerationAnswer::create($validated);

        return response()->json($idAnswer, 201);
    }

    public function show(EnumerationAnswer $idAnswer)
    {
        return response()->json($idAnswer);
    }

    public function update(Request $request, EnumerationAnswer $idAnswer)
    {
        $validated = $request->validate([
            'answer' => 'nullable|string',
            'question_id' => 'nullable|exists:assessment_questions,question_id'
        ]);

        $idAnswer->update($validated);

        return response()->json($idAnswer);
    }

    public function destroy(EnumerationAnswer $idAnswer)
    {
        $idAnswer->delete();

        return response()->json(null, 204);
    }
}
