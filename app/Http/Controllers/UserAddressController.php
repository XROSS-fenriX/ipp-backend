<?php

namespace App\Http\Controllers;

use App\Models\Profile\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return response()->json(
                UserAddress::all()
            );
        }

        if ($user->role === 'teacher' || $user->role === 'student') {
            return response()->json(
                $user->addresses
            );
        }

        return response()->json(['message' => 'Unauthorized access.'], 403);
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

    public function show(Request $request, UserAddress $address)
    {
        $user = $request->user();

        if ($user->role === 'admin') {
            return response()->json($address);
        }

        if (
            in_array($user->role, ['teacher', 'student']) &&
            $address->user_id === $user->user_id
        ) {
            return response()->json($address);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
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
