<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register()
    {
        $validateData = request()->validate([
            'nip' => 'required',
            'password' => 'required|min:8'
        ]);

        $check_pegawai = Pegawai::where('nip', $validateData['nip'])->get();
        if(!empty($check_pegawai)) {
            $validateData['perusahaan_id'] = $check_pegawai[0]->jabatan->jadwal->departemen->perusahaan->id;
            $validateData['departemen_id'] = $check_pegawai[0]->jabatan->jadwal->departemen->id;
            $validateData['pegawai_id'] = $check_pegawai[0]->id;
            $validateData['name'] = $check_pegawai[0]->email;
            $validateData['password'] = bcrypt($validateData['password']);
            $validateData['peran'] = 'Pegawai';
            $validateData['status'] = 'Aktif';
    
            $user = User::create($validateData);
    
            return response(['user' => $user], 201);
        };

    }

    public function login()
    {
        $loginData = request()->validate([
            'name' => 'email|required',
            'password' => 'required|min:8'
        ]);

        $check_user = User::where('peran', 'Pegawai')->where('name', $loginData['name'])->get();
        if(count($check_user) > 0) {
            if(password_verify($loginData['password'], $check_user[0]->password)) {
                return response()->json(['user' => $check_user[0], 'Log' => 1]);
            } else {
                return response(['message' => 'Username Atau Password Salah'], 400);
            };
        } else {
            return response(['message' => 'User Belum Terdaftar'], 400);
        };
    }

    public function logout() 
    {
        return response()->json(['Log' => 0]);
    }
}