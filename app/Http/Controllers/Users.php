<?php

/**
 * Dear Maintainer
 * 
 * When I wrote this code
 * Only God and I know what it was
 * Now, only God know what it was :)
 * 
 * Stay Tawakal and Keep Ikhtiar
 * May god give you clue about it
 * 
 * Recent Maintainer :
 * SMKN 1 Bondowoso 2022/2023 Students
**/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    public function superRegist() {
        $managerData = request()->validate([
            'name' => 'required|max:25|min:5|unique:users',
            'username' => 'required|max:25|min:5|unique:users',
            'email' => 'required|email:dns',
            'password' => 'required|max:16|min:8'
        ]);
        $managerData['password'] = bcrypt($managerData['password']);
        $managerData['peran'] = 'Atasan Utama';
        $managerData['status'] = 'Lisensi';

        User::create($managerData);

        return redirect('/login');
    }

    public function login() {
        $validate = request()->validate([
            'identity' => 'required',
            'password' => 'required|min:8|max:25'
        ]);

        $loggedUser = User::where('name', $validate['identity'])->orWhere('username', $validate['identity'])->orWhere('email', $validate['identity'])->limit(1)->get();

        $method = '';
        if($loggedUser[0]->name == $validate['identity']) {
            $method = 'name';
        };
        if($loggedUser[0]->username == $validate['identity']) {
            $method = 'username';
        };
        if($loggedUser[0]->email == $validate['identity']) {
            $method = 'email';
        };

        $userData = [
            $method => $validate['identity'],
            'password' => $validate['password']
        ];

        if(Auth::attempt($userData)) {
            if($loggedUser[0]->status === 'Lisensi') {
                request()->session()->regenerate();
                return redirect()->intended('/wizard');
            } else if($loggedUser[0]->status === 'Aktif') {
                if($loggedUser[0]->peran === 'Pengelola' || $loggedUser[0]->peran === 'Pengelola Utama' || $loggedUser[0]->peran === 'Atasan' || $loggedUser[0]->peran === 'Atasan Utama') {
                    request()->session()->regenerate();
                    return redirect()->intended('/dashboard');
                } else if($loggedUser[0]->peran === 'Super Admin') {
                    request()->session()->regenerate();
                    return redirect()->intended('/superDashboard');
                } else {
                    Auth::logout();
                    return back()->with('login_failed', 'Anda tidak memiliki hak akses!')->withInput();
                }
            };
        };

        return back()->with('login_failed', 'Username atau Password salah!')->withInput();
    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect('/login');
    }
}
