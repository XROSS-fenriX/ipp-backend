<?php

namespace App\Http\Controllers;

use App\Models\School\NationalHoliday;
use Illuminate\Http\Request;

class NationalHolidayController extends Controller
{
    public function index()
    {
        return response()->json(NationalHoliday::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'holiday_name' => 'required|string',
            'date' => 'required|date'
        ]);

        $holiday = NationalHoliday::create($validated);

        return response()->json($holiday, 201);
    }

    public function show(NationalHoliday $holiday)
    {
        return response()->json($holiday);
    }

    public function update(Request $request, NationalHoliday $holiday)
    {
        $validated = $request->validate([
            'holiday_name' => 'nullable|string',
            'date' => 'nullable|date'
        ]);

        $holiday->update($validated);

        return response()->json($holiday);
    }

    public function destroy(NationalHoliday $holiday)
    {
        $holiday->delete();

        return response()->json(null, 204);
    }
}
