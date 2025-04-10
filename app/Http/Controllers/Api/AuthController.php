<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login(Request $request)
    {
       $fieds = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fieds['email'])->first();
        if(!$user || !Hash::check($fieds['password'], $user->password)){
            return response()->json([
                'message' => 'Invalid credentials'
            ], 200);
        }
        $token = $user->createToken('inventory')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

        
    public function register(Request $request)
    {
       $fieds = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $fieds['name'],
            'email' => $fieds['email'],
            'password' => Hash::make($fieds['password']),
            'role' => $fieds['role'],
        ]);
        
        $token = $user->createToken('inventory')->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token
        ] ,201);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
