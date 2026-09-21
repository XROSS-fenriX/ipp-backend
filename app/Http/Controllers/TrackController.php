<?php

namespace App\Http\Controllers;

use App\Models\Academic\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        return response()->json(Track::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'track_name' => 'required|string'
        ]);

        $track = Track::create($validated);

        return response()->json($track, 201);
    }

    public function show(Track $track)
    {
        return response()->json($track);
    }

    public function update(Request $request, Track $track)
    {
        $validated = $request->validate([
            'track_name' => 'nullable|string'
        ]);

        $track->update($validated);

        return response()->json($track);
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return response()->json(null, 204);
    }
}
