<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class EntradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function entrada(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        // print_r($data);


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 401);
        }
        $token = $user->createToken('DSN_TFM_2024@dsansn@uoc.eu')->accessToken; // ->plainTextToken;
        $roles = $user->roles;
     
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function index()
    {
        $users = User::find(1);
        $roles = $users->roles;
        return response()->json([
            'status' => true,
            'users' => $users
        ]);
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}