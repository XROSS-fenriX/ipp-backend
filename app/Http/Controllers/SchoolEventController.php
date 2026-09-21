<?php

namespace App\Http\Controllers;

use App\Models\School\SchoolEvent;
use Illuminate\Http\Request;

class SchoolEventController extends Controller
{
    public function index()
    {
        return response()->json(SchoolEvent::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'event_scope' => 'required|string',
            'event_type' => 'required|string',
            'event_description' => 'nullable|string',
            'event_location' => 'nullable|string',
            'color_tag' => 'nullable|string',
            'school_id' => 'required|exists:schools,school_id'
        ]);

        $event = SchoolEvent::create($validated);

        return response()->json($event, 201);
    }

    public function show(SchoolEvent $event)
    {
        return response()->json($event);
    }

    public function update(Request $request, SchoolEvent $event)
    {
        $validated = $request->validate([
            'event_name' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'event_scope' => 'nullable|string',
            'event_type' => 'nullable|string',
            'event_description' => 'nullable|string',
            'event_location' => 'nullable|string',
            'color_tag' => 'nullable|string',
            'school_id' => 'nullable|exists:schools,school_id'
        ]);

        $event->update($validated);

        return response()->json($event);
    }

    public function destroy(SchoolEvent $event)
    {
        $event->delete();

        return response()->json(null, 204);
    }
}
