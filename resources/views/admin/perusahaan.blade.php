@extends('admin.layout.master')

@section('admin')

<div class="data-template">
    <div class="data-content master-template">
        <div class="data-controller">
            <div class="controller-role">
                <i class="fa-solid fa-book-journal-whills"></i>
                Profil Perusahaan
            </div>
        </div>
        <div class="rekap-area">
            <div class="company-header">
                <div class="company-logo">
                    @if (isset($data->logo_instansi))
                        <img src="{{ asset('storage') }}/{{ $data->logo_instansi }}" draggable="false">
                    @else
                        <i class="fa-solid fa-plus"></i>
                        <br>
                        <span>Tambahkan Logo</span>
                    @endif
                    <form action="/dashboard/perusahaan/logo" method="post" enctype="multipart/form-data">
                        @csrf
                        <input class="company-logo-input" type="file" name="logo_instansi" accept="image/png, image/jpg. image/jpeg">
                        <button class="confirm-logo" type="submit">
                            <i class="fa-solid fa-rotate-right"></i>
                        </button>
                    </form>
                </div>
                <div class="company-name">
                    <h1>{{ $data->nama_instansi }}</h1>
                    <br>
                    <span>
                        {{ $data->deskripsi_instansi }}
                    </span>
                </div>
            </div>
            <div class="company-desc"></div>
        </div>
        <div class="company-box-container">
            <div class="company-box-data location">
                <div class="company-box-col company-box-logo">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div class="company-box-col company-box-content">{{ $data->alamat_instansi }}</div>
            </div>
            <div class="company-box-data contact">
                <div class="company-box-col company-box-logo">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="company-box-col company-box-content">{{ $data->kontak_instansi }}</div>
            </div>
            <div class="company-box-data site">
                <div class="company-box-col company-box-logo">
                    <i class="fa-solid fa-globe"></i>
                </div>
                <div class="company-box-col company-box-content">{{ $data->website_instansi }}</div>
            </div>
        </div>
    </div>
</div>
    
@endsection