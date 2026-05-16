<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GoogleAuthController extends Controller
{
    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'google_id' => 'required|string',
            'photo_url' => 'nullable|string',
            'id_token' => 'nullable|string',
        ]);

        if ($v->fails()) {
            return response()->json([
                'success' => false,
                'message' => $v->errors()->first(),
            ], 422);
        }

        $googleId = (string) $request->google_id;

        // Cari berdasarkan google_id, fallback email.
        $user = User::where('google_id', $googleId)->first();
        if (!$user) {
            $user = User::where('email', $request->email)->first();
        }

        if (!$user) {
            $user = User::create([
                'name' => $request->name ?? 'Google User',
                'email' => $request->email,
                'google_id' => $googleId,
                'foto_profile' => $request->photo_url ?? '',
                // password nullable/required? Di model ini password fillable, tapi login manual butuh password.
                // Untuk Google login, buat password random agar record valid.
                'password' => Hash::make(uniqid('google_', true)),
            ]);
        } else {
            $user->update([
                'name' => $request->name ?? $user->name,
                'google_id' => $googleId,
                'foto_profile' => $request->photo_url ?? $user->foto_profile,
            ]);
        }

        // Reset token lama agar sesuai pola login manual.
        $user->tokens()->delete();
        $token = $user->createToken('alliumx')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login Google berhasil',
            'token' => $token,
            'user' => $this->_userResponse($user),
        ]);
    }

    private function _userResponse(User $user): array
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        return [
            'id' => $user->id,
            'nama' => $user->name,
            'name' => $user->name,
            'email' => $user->email,
            // Flutter sudah pakai foto_profile untuk avatar
            'foto_profile' => $user->foto_profile ?? ($user->photo_url ?? ''),
            'role' => $user->role ?? 'petani',
            'join_date' => $user->created_at
                ? $months[$user->created_at->month - 1] . ' ' . $user->created_at->year
                : '',
        ];
    }
}

