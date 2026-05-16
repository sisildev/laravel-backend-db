<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'nama' => 'required_without:name|string|max:255',
            'name' => 'required_without:nama|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($v->fails()) {
            return response()->json([
                'success' => false,
                'message' => $v->errors()->first(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->nama ?? $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone ?? '',
            'location' => $request->location ?? '',
        ]);

        $token = $user->createToken('alliumx')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'token' => $token,
            'user' => $this->_userResponse($user),
        ], 201);
    }

    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($v->fails()) {
            return response()->json([
                'success' => false,
                'message' => $v->errors()->first(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user->tokens()->delete();

        $token = $user->createToken('alliumx')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $this->_userResponse($user),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $this->_userResponse($request->user()),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $user->update([
            'name' => $request->name ?? $request->nama ?? $user->name,
            'phone' => $request->phone ?? $user->phone,
            'location' => $request->location ?? $user->location,
            'foto_profile' => $request->foto_profile ?? $user->foto_profile,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diperbarui',
            'user' => $this->_userResponse($user->fresh()),
        ]);
    }

    private function _userResponse(User $user): array
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        return [
            'id' => $user->id,
            'nama' => $user->name,
            'name' => $user->name,
            'phone' => $user->phone ?? '',
            'location' => $user->location ?? '',
            'email' => $user->email,
            'foto_profile' => $user->foto_profile ?? '',
            'role' => $user->role ?? 'petani',
            'join_date' => $user->created_at
                ? $months[$user->created_at->month - 1] . ' ' . $user->created_at->year
                : '',
        ];
    }
}