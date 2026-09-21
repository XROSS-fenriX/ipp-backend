<?php

namespace App\Http\Controllers;

use App\Models\Academic\McqChoice;
use Illuminate\Http\Request;

class McqChoiceController extends Controller
{
    public function index()
    {
        return response()->json(McqChoice::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'choice' => 'required|string',
            'is_correct' => 'required|boolean',
            'question_id' => 'required|exists:assessment_questions,question_id'
        ]);

        $choice = McqChoice::create($validated);

        return response()->json($choice, 201);
    }

    public function show(McqChoice $choice)
    {
        return response()->json($choice);
    }

    public function update(Request $request, McqChoice $choice)
    {
        $validated = $request->validate([
            'choice' => 'nullable|string',
            'is_correct' => 'nullable|boolean',
            'question_id' => 'nullable|exists:assessment_questions,question_id'
        ]);

        $choice->update($validated);

        return response()->json($choice);
    }

    public function destroy(McqChoice $choice)
    {
        $choice->delete();

        return response()->json(null, 204);
    }
}
