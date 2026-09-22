<?php

namespace App\Http\Controllers;

use App\Models\School\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return response()->json(
                Incident::all()
            );
        }

        if ($user->role === 'teacher' || $user->role === 'student') {
            return response()->json(
                $user->incidents
            );
        }

        return response()->json(['message' => 'Unauthorized access.'], 403);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'intensity' => 'required|string',
            'is_actioned' => 'required|boolean',
            'description' => 'nullable|string',
            'caused_by' => 'nullable|exists:users,user_id'
        ]);

        $incident = Incident::create($validated);

        return response()->json($incident, 201);
    }

    public function show(Request $request, Incident $incident)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return response()->json($incident);
        }

        if (
            in_array($user->role, ['teacher', 'student']) &&
            $incident->caused_by === $user->user_id
        ) {
            return response()->json($incident);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, Incident $incident)
    {
        $validated = $request->validate([
            'type' => 'nullable|string',
            'intensity' => 'nullable|string',
            'is_actioned' => 'nullable|boolean',
            'description' => 'nullable|string',
            'caused_by' => 'nullable|exists:users,user_id'
        ]);

        $incident->update($validated);

        return response()->json($incident);
    }

    public function destroy(Incident $incident)
    {
        $incident->delete();

        return response()->json(null, 204);
    }
}
