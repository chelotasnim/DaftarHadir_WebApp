<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Perusahaans extends Controller
{
    public function logo() {
        $logo = request()->validate([
            'logo_instansi' => 'image|max:1024|required'
        ]);

        if(request()->file('logo_instansi')) {
            $logo['logo_instansi'] = request()->file('logo_instansi')->store('LogoInstansi');
        };

        Instansi::where('id', Auth::user()->instansi->id)->update(['logo_instansi' => $logo['logo_instansi']]);

        return redirect('/dashboard/perusahaan');
    }
}
