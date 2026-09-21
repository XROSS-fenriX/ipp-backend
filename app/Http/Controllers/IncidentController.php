<?php

namespace App\Http\Controllers;

use App\Models\School\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        return response()->json(Incident::all());
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

    public function show(Incident $incident)
    {
        return response()->json($incident);
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
