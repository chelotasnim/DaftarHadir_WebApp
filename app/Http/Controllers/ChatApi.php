<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Departemen;
use App\Models\Instansi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatApi extends Controller
{
    public function showChat() {
        if(empty($_GET['token']) || $_GET['token'] !== 'Fghjjn798HWCGSM') {
            return redirect('/login');
        };

        $my_id = $_GET['my_id'];
        $departemen_id = $_GET['departemen_id'];
        $perusahaan_id = $_GET['perusahaan_id'];

        $departemen = Departemen::where('id', $departemen_id)->get();
        $perusahaan = Instansi::where('id', $perusahaan_id)->get();
        if(count($departemen) > 0 && count($perusahaan) > 0) {
            $requested_data = [];

            $get_admin = User::where('departemen_id', $departemen[0]->id)->where('peran', '!=', 'Pegawai')->orWhere('peran', 'Atasan Utama')->where('perusahaan_id', $perusahaan[0]->id)->orWhere('peran', 'Pengelola Utama')->where('perusahaan_id', $perusahaan[0]->id)->get();

            foreach ($get_admin as $admin) {
                $latest_chat = Chat::where('pengirim_id', $admin->id)->where('penerima_id', $my_id)->orWhere('pengirim_id', $my_id)->where('penerima_id', $admin->id)->latest()->limit(1)->get();
                if(count($latest_chat) === 1) {
                    $admin['messages'] = $latest_chat[0]->messages;
                    $admin['status_chat'] = $latest_chat[0]->status;
                    $admin['time'] = Carbon::parse($latest_chat[0]->created_at)->format('H') . ' : ' . Carbon::parse($latest_chat[0]->created_at)->format('i') . ' | ';
                } else {
                    $admin['messages'] = 'Belum Ada Percakapan';
                    $admin['time'] = '';
                };
                
                array_push($requested_data, $admin);
            };

            return $requested_data;
        };
    }

    public function enterChat() {
        if(empty($_GET['token']) || $_GET['token'] !== 'POnsbcvHW7821n') {
            return redirect('/login');
        };

        $my_id = $_GET['my_id'];
        $other_user = $_GET['other_id'];

        $chat = Chat::where('pengirim_id', $other_user)->where('penerima_id', $my_id)->orWhere('pengirim_id', $my_id)->where('penerima_id', $other_user)->get();

        return $chat;
    }
}
