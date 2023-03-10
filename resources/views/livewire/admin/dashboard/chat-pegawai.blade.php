<div wire:poll.10ms class="chat-app">
    <div class="chat-list">
        <div class="app-header">
            <div class="profile">
                <div class="logo">
                    <i class="fa-solid fa-user-gear"></i>
                </div>
                <div class="profile-data">
                    <p>
                        @if (empty(Auth::user()->departemen_id))
                            {{ Auth::user()->name }}
                        @else 
                            {{ Auth::user()->pegawai->nama }}
                        @endif
                    </p>
                    <span class="profile-tip">{{ Auth::user()->peran }}</span>
                </div>
            </div>
            <div class="app-clock">
                <span class="hour">{{ \Carbon\Carbon::now()->format('H') }}</span>
                <span class="minute">{{ \Carbon\Carbon::now()->format('i') }}</span>
            </div>
        </div>
        <div class="chat-search">
            <div class="chat-search-box">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Cari nama pegawai sebagai kontak" autocomplete="off" wire:model="nama_pegawai" wire:keydown="searchPegawai">
            </div>
        </div>
        <div class="chat-list-container">
            @if (!empty($show_pegawai))
                <div class="chat-row" wire:click="enterChat({{ $show_pegawai->id }})">
                    <p><span class="as-label">{{ $show_pegawai->pegawai->jabatan->jabatan }}</span> {{ $show_pegawai->pegawai->nama }}</p>
                    @if (!empty($show_pegawai['latest_messages']->created_at))
                        <span class="excerp-chat">{{ \Carbon\Carbon::parse($show_pegawai['latest_messages']->created_at)->format('H:i') }} | {{ $show_pegawai['latest_messages']->messages }}</span>
                        @if ($show_pegawai['latest_messages']->status === 0 && $show_pegawai['latest_messages']->penerima_id == Auth::user()->id)
                            <div class="unread-notif"></div>
                        @endif
                    @else
                        <span class="excerp-chat">Belum ada percakapan disini</span>
                    @endif
                </div>
            @endif
            @foreach ($user_latest_chat as $chat)    
                <div class="chat-row" wire:click="enterChat({{ $chat['id'] }})">
                    <p><span class="as-label">{{ $chat['role'] }}</span> {{ $chat['name'] }}</p>
                    @if (!empty($chat['latest_messages']))
                        <span class="excerp-chat">{{ \Carbon\Carbon::parse($chat['messages_time'])->format('H:i') }} | {{ $chat['latest_messages'] }}</span>
                        @if ($chat['messages_status'] === 0 && $chat['penerima'] == Auth::user()->id)
                            <div class="unread-notif"></div>
                        @endif
                    @else
                        <span class="excerp-chat">Belum ada percakapan disini</span>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="floating-btn">
            <i class="fa-solid fa-bell"></i>
        </div>
    </div>
    <div class="chat-content">
        @if ($page === 200)
            <div class="chat-session">
                <div class="app-header">
                    <div class="profile">
                        <div class="logo">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="profile-data">
                            @if ($user_chatted[0]->peran === 'Pegawai')
                                <p>{{ $user_chatted[0]->pegawai->nama }}</p>
                                <span class="profile-tip">{{ $user_chatted[0]->pegawai->jabatan->jabatan }} {{ $user_chatted[0]->pegawai->jabatan->jadwal->departemen->nama_dept }}</span>
                            @elseif ($user_chatted[0]->peran === 'Pengelola' || $user_chatted[0]->peran === 'Atasan')
                                <p>{{ $user_chatted[0]->pegawai->nama }}</p>
                                <span class="profile-tip">{{ $user_chatted[0]->peran }} {{ $user_chatted[0]->pegawai->jabatan->jadwal->departemen->nama_dept }}</span>
                            @else
                                <p>{{ $user_chatted[0]->name }}</p>
                                <span class="profile-tip">{{ $user_chatted[0]->peran }} {{ $user_chatted[0]->instansi->nama_instansi }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="chat-history" wire:click.prefetch="readChat({{ $user_chatted[0]->id }},{{ Auth::user()->id }})">
                    @if (count($chat_history) > 0)
                        @foreach ($chat_history as $day => $messages)
                            <div class="date-line">{{ $day }}</div>
                            @foreach ($messages as $chat)    
                                @if ($chat['pengirim_id'] == Auth::user()->id)
                                    <div class="messages-row owned-by-you">
                                        <div class="messages-box">
                                            <div class="messages">{{ $chat['messages'] }}</div>
                                            <div class="chat-time-sended">
                                            @if ($chat['status'] === 1)
                                                <i class="fa-solid fa-eye"></i>
                                            @else
                                                <i class="fa-solid fa-check"></i>
                                            @endif
                                            {{ \Carbon\Carbon::parse($chat['created_at'])->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="messages-row">
                                        <div class="messages-box">
                                            <div class="messages">{{ $chat['messages'] }}</div>
                                            <div class="chat-time-sended">{{ \Carbon\Carbon::parse($chat['created_at'])->setTimezone('Asia/Jakarta')->format('H:i') }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @else
                        <div class="welcome-chat">
                            <img src="{{ asset('assets/no-chat.png') }}" draggable="false">
                            <h1>Mulai Percakapan!</h1>
                            <p>
                                Anda belum memulai percakapan apapun dengan pegawai disini, mulailah dengan mengirim pesan
                            </p>
                        </div>
                    @endif
                </div>
                <div class="quick-messages">
                    <div class="q-messages-components add-messages-btn" wire:click="toggleNewQmessages">
                        @if ($add_q_messages == false)
                            <i class="fa-solid fa-plus"></i>
                        @else
                            <i class="fa-solid fa-minus"></i>
                        @endif
                    </div>
                    @if ($add_q_messages == true)
                        <div class="q-messages-components input-quick-messages">
                            <input type="text" wire:model.defer="q_messages" autocomplete="off" placeholder="Ketik Pesan Cepat" wire:keydown.enter="addQmessages({{ $user_chatted[0]->id }})">
                            <i class="fa-solid fa-paper-plane" wire:click="addQmessages({{ $user_chatted[0]->id }})"></i>
                        </div>
                    @endif
                    @foreach ($quick_messages as $message)
                        <div class="q-messages-components quick-messages-list">
                            <span wire:click="sendMessages({{ $user_chatted[0]->id }}, '{{ $message->messages }}')">{{ $message->messages }}</span><span class="red"><i class="fa-solid fa-xmark" wire:click="removeQmessages({{ $message->id }})"></i></span>
                        </div>
                    @endforeach
                </div>
                <div class="chat-sender">
                    <div class="add-document chat-btn">
                        <i class="fa-solid fa-file-circle-plus"></i>
                    </div>
                    <div class="chat-box-typer">
                        <input type="text" autocomplete="off" placeholder="Ketik Pesan" wire:model.defer="main_messages" wire:keydown.enter="sendMessages({{ $user_chatted[0]->id }}, '')">
                    </div>
                    <div class="send-chat chat-btn" wire:click="sendMessages({{ $user_chatted[0]->id }}, '')">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        @else
            <div class="welcome-chat">
                <img src="{{ asset('assets/chat.png') }}" draggable="false">
                <h1>Live-Chat Pegawai</h1>
                <p>
                    Kirim dan terima pesan berbagai format dari pegawai sebagai pendukung sistem presensi utama
                </p>
            </div>
        @endif
    </div>
</div>