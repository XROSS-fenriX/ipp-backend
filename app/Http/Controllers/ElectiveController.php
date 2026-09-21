<?php

namespace App\Http\Controllers;

use App\Models\Academic\Elective;
use Illuminate\Http\Request;

class ElectiveController extends Controller
{
    public function index()
    {
        return response()->json(Elective::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'elective_name' => 'required|string',
            'track_id' => 'required|exists:tracks,track_id'
        ]);

        $elective = Elective::create($validated);

        return response()->json($elective, 201);
    }

    public function show(Elective $elective)
    {
        return response()->json($elective);
    }

    public function update(Request $request, Elective $elective)
    {
        $validated = $request->validate([
            'elective_name' => 'nullable|string',
            'track_id' => 'nullable|exists:tracks,track_id'
        ]);

        $elective->update($validated);

        return response()->json($elective);
    }

    public function destroy(Elective $elective)
    {
        $elective->delete();

        return response()->json(null, 204);
    }
}
