<div wire:poll class="data-template">
    <div class="req-card-container">
        <p class="no-data"><span><i class="fa-regular fa-envelope-open"></i></span> Belum ada pengajuan</p>
        @foreach ($allAdmin as $admin)
            @foreach ($admin->reqAktivitas as $req)
                <div class="req-card">
                    <div class="req-head">
                        <p class="tip">Pengajuan</p>
                        <h5>{{ $req->jenis_pengajuan }}</h5>
                        @if ($req->status_pengajuan === 'Menunggu Approval')
                            <div class="req-status">{{ $req->status_pengajuan }}</div>                            
                        @endif
                        @if ($req->status_pengajuan === 'Approved')
                            <div class="req-status approved">{{ $req->status_pengajuan }}</div>                            
                        @endif
                        @if ($req->status_pengajuan === 'Refused')
                            <div class="req-status refused">{{ $req->status_pengajuan }}</div>                            
                        @endif
                        <div class="req-action">
                            @if ($req->status_pengajuan === 'Menunggu Approval')
                                <span wire:click="approved({{ $req->id }})" class="as-label evented-btn green">
                                    <i class="fa-solid fa-check"></i>
                                    Approve
                                </span>
                                <span wire:click="refused({{ $req->id }})" class="as-label evented-btn red refuse-btn">
                                    <i class="fa-solid fa-xmark"></i>
                                    Refuse
                                </span>
                            @else
                                <span wire:click="trash({{ $req->id }})" onclick="noData()" class="as-label evented-btn grey">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Buang (Telah Diverifikasi)
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="req-desc">
                        <p class="desc-title">Keterangan</p>
                        <p class="desc-sender">
                            {{ $req->keterangan_pengirim }}
                        </p>
                        <p class="desc-author">By : {{ $req->sender->name }}</p>
                        <span onclick="showModal({{ $req->id }}, 'more')" class="as-label evented-btn modal-trigger">
                            Lihat Detail
                        </span>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>

    <div class="data-modal acc-modal">
        @foreach ($allAdmin as $admin)
            @foreach ($admin->reqAktivitas as $req)
                <div class="modal-card">
                    <span class="modal-id">{{ $req->id }}</span>
                    <span class="modal-fn">more</span>
                    <div class="form-head-type-2">
                        <p>Pengajuan</p>
                        <h5>{{ $req->jenis_pengajuan }}</h5>
                    </div>
                    <div class="form-form">
                        @if ($req->jenis_pengajuan === 'Perubahan')
                            <div class="change-list">
                                {!! $req->list_perubahan !!}
                            </div>
                        @else
                            <div class="form-row">
                                <div class="form-field">
                                    <label>Departemen</label>
                                    <input type="text" value="{{ $req->departemen->nama_dept }}" disabled> 
                                </div>
                            </div>
                            <div class="form-row" style="margin: 0; margin-bottom: 8px">
                                <div class="form-field">
                                    <label>Jenis Aktivitas</label>
                                    <input type="text" value="{{ $req->aktivitas }}" disabled> 
                                </div>
                            </div>
                        @endif
                    </div>
                    <div onclick="closeModal(this)" class="close-btn">
                        <i class="fa-solid fa-square-xmark"></i>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>