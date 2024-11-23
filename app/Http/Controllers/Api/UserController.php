<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $data = UserResource::collection($users);

        return response()->json([
            'message' => 'Berhasil menampilkan data',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $field = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required'
        ]);

        $token = User::generateToken();
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'token' => $token
        ]);

        $data = new UserResource($user);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $data
        ], 201);
    }

    public function show($id)
    {
        $user = User::with('role')->find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $data = new UserResource($user);

        return response()->json([
            'message' => 'Berhasil menampilkan data ' . $id,
            'data' => $data
        ], 200);
    }
}
