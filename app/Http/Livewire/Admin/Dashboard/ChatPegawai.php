<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Chat;
use App\Models\Pegawai;
use App\Models\QuickMessages;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatPegawai extends Component
{
    public $page = 0;
    public $user_chatted = [];
    public $q_messages;
    public $add_q_messages = false;
    public $main_messages;
    public $chat_history;
    public $id_user_chatted;
    public $nama_pegawai;
    public $show_pegawai;
    public function render()
    {
        $atasan_utama = [];
        if(Auth::user()->peran == 'Atasan Utama') {
            $atasan_utama = User::where('perusahaan_id', Auth::user()->instansi->id)->where('peran', '!=', 'Pegawai')->where('peran', '!=', 'Atasan Utama')->get();
        } else if(Auth::user()->peran == 'Pengelola Utama') {
            $atasan_utama = User::where('perusahaan_id', Auth::user()->instansi->id)->where('peran', '!=', 'Pegawai')->where('peran', '!=', 'Pengelola Utama')->get();
        } else {
            $atasan_utama = User::where('perusahaan_id', Auth::user()->instansi->id)->where('peran', '!=', 'Pegawai')->where('id', '!=', Auth::user()->id)->get();
        };

        $user_latest_chat = [];

        foreach ($atasan_utama as $atasan) {
            $pesan_utama = Chat::where('pengirim_id', $atasan->id)->where('penerima_id', Auth::user()->id)->orWhere('pengirim_id', Auth::user()->id)->where('penerima_id', $atasan->id)->latest()->limit(1)->get();
            $temporary['id'] = $atasan->id;
            $temporary['penerima'] = '';
            $temporary['name'] = $atasan->name;
            $temporary['role'] = $atasan->peran;
            $temporary['latest_messages'] = '';
            if(count($pesan_utama) > 0) {
                $temporary['penerima'] = $pesan_utama[0]->penerima_id;
                $temporary['latest_messages'] = $pesan_utama[0]->messages;
                $temporary['messages_status'] = $pesan_utama[0]->status;
                $temporary['messages_time'] = $pesan_utama[0]->created_at;
            };
            if($atasan->peran == 'Pengelola' || $atasan->peran == 'Atasan') {
                $temporary['name'] = $atasan->pegawai->nama;
            };

            array_push($user_latest_chat, $temporary);
        };

        $quick_messages = QuickMessages::where('user_id', Auth::user()->id)->get();

        if(!empty($this->id_user_chatted)) {
            $this->enterChat($this->id_user_chatted);
        };

        $this->searchPegawai();

        return view('livewire.admin.dashboard.chat-pegawai', [
            'user_latest_chat' => $user_latest_chat,
            'quick_messages' => $quick_messages
        ]);
    }

    public function enterChat($id) {
        $this->id_user_chatted = $id;
        $this->page = 200;

        $this->user_chatted = User::where('id', $id)->get();
        $this->chat_history = Chat::where('pengirim_id', $this->user_chatted[0]->id)->where('penerima_id', Auth::user()->id)->orWhere('pengirim_id', Auth::user()->id)->where('penerima_id', $this->user_chatted[0]->id)->get()->groupBy(function($date) { return Carbon::parse($date->created_at)->isoFormat('dddd, D MMMM Y'); })->toBase();
    }

    public function toggleNewQmessages() {
        if($this->add_q_messages == false) {
            $this->add_q_messages = true;
        } else {
            $this->add_q_messages = false;
        };
    }

    public function addQmessages($id) {
        $messages_data['user_id'] = Auth::user()->id;
        $messages_data['messages'] = $this->q_messages;

        QuickMessages::create($messages_data);

        $this->reset();
        $this->add_q_messages = false;

        $this->enterChat($id);
    }

    public function removeQmessages($id) {
        QuickMessages::where('id', $id)->delete();
    }

    public function sendMessages($id, $messages) {
        $requested_messages = [];
        if(empty($messages)) {
            $requested_messages = $this->validate(['main_messages' => 'required']);
        } else {
            $requested_messages['main_messages'] = $messages;
        };

        $chat_data['messages'] = $requested_messages['main_messages'];
        $chat_data['pengirim_id'] = Auth::user()->id;
        $chat_data['penerima_id'] = $id;
        $chat_data['status'] = 0;

        Chat::create($chat_data);

        $this->reset();

        $this->enterChat($id);
    }

    public function readChat($sender, $receiver) {
        $chats = Chat::where('pengirim_id', $sender)->where('penerima_id', $receiver)->get();
        foreach ($chats as $chat) {
            if($chat->status === 0) {
                Chat::where('id', $chat->id)->update(['status' => 1]);
            };
        };

        $this->reset();
    }

    public function searchPegawai() {
        $pegawai_as_user = User::where('perusahaan_id', Auth::user()->instansi->id)->where('name', 'like', '%' . $this->nama_pegawai . '%')->where('peran', 'Pegawai')->latest()->limit(1)->get();
        if(count($pegawai_as_user) === 1) {
            $latest_chat = Chat::where('pengirim_id', $pegawai_as_user[0]->id)->where('penerima_id', Auth::user()->id)->orWhere('pengirim_id', Auth::user()->id)->where('penerima_id', $pegawai_as_user[0]->id)->latest()->limit(1)->get();

            if(count($latest_chat) === 1) {
                $pegawai_as_user[0]['latest_messages'] = $latest_chat[0];
            } else {
                $pegawai_as_user[0]['latest_messages'] = 'Belum ada percakapan disini';
            };

            $this->show_pegawai = $pegawai_as_user[0];
        };

        if(strlen($this->nama_pegawai) < 2) {
            $this->show_pegawai = [];
        }
    }

    public function leaveChat() {
        $this->reset();
    }
}
