<?php

namespace App\Http\Controllers;

use App\Models\Profile\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function index()
    {
        return response()->json(UserAddress::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address_type' => 'required|string',
            'house_no' => 'nullable|string',
            'street' => 'required|string',
            'barangay' => 'required|string',
            'municipality' => 'required|string',
            'province' => 'required|string',
            'user_id' => 'required|exists:users,user_id'
        ]);

        $address = UserAddress::create($validated);

        return response()->json($address, 201);
    }

    public function show(UserAddress $address)
    {
        return response()->json($address);
    }

    public function update(Request $request, UserAddress $address)
    {
        $validated = $request->validate([
            'address_type' => 'nullable|string',
            'house_no' => 'nullable|string',
            'street' => 'nullable|string',
            'barangay' => 'nullable|string',
            'municipality' => 'nullable|string',
            'province' => 'nullable|string',
            'user_id' => 'nullable|exists:users,user_id'
        ]);

        $address->update($validated);

        return response()->json($address);
    }

    public function destroy(UserAddress $address)
    {
        $address->delete();

        return response()->json(null, 204);
    }
}
