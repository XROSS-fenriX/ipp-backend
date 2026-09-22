<?php

namespace App\Http\Controllers;

use App\Models\Academic\Elective;
use Illuminate\Http\Request;

class ElectiveController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return response()->json(
                Elective::all()
            );
        }

        if ($user->role === 'teacher' || $user->role === 'student') {
            return response()->json(
                $user->electives
            );
        }

        return response()->json(['message' => 'Unauthorized access.'], 403);
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

    public function show(Request $request, Elective $elective)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return response()->json($elective);
        }

        if (in_array($user->role, ['teacher', 'student']) &&
            $user->electives->contains('elective_id', $elective->elective_id))
        {
            return response()->json($elective);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
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
