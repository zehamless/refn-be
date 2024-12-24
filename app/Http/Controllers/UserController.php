<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->validate(['search' => 'string|nullable'])['search'] ?? null;

        $users = User::query()
            ->role('customer')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%");
            })
            ->get();

        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'customer' => 'boolean|required',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt(fake()->password()),

        ]);
        $user->assignRole('customer');
        return new UserResource($user);
    }

    public function show($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
