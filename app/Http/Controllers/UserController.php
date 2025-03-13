<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    public function index()
    {
        //tambah data user dengan Eloquent Model
        $data = [
            'level_id' => 2,
            'username' => 'manager_tiga',
            'nama' => 'manager 3',
            'password' => Hash::make(12345)
        ];
        UserModel::create($data); //tambahkan data ke tabel m_user

        //coba akses UserModel
        $user =UserModel::all();//ambil semua data dari tabel user
        return view('user', ['data'=> $user]);

    }
}