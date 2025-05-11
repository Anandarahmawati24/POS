<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $levels = LevelModel::all();
        return view('auth.register', compact('levels'));
    }

    public function register(Request $request)
{
    $request->validate([
        'username' => 'required|min:4|max:20',
        'nama' => 'required|max:100',
        'password' => 'required|min:6|max:20',
        'password_confirmation' => 'required|same:password',
        'level_id' => 'required',
    ]);

    try {
        $user = UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pendaftaran berhasil!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Terjadi kesalahan saat menyimpan data!',
        ]);
    }
}
}