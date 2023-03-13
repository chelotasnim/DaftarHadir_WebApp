@extends('admin.layout.master')

@section('admin')

<div class="data-template" style="height: 100%">
    <div class="data-content" style="position: absolute; height: 100%; width: 100%; margin-top: 0">
        @if (session()->has('success'))
            <div class="notif success new">
                <i class="fa-solid fa-square-check"></i>
                {{ session('success') }}
            </div>
        @endif
        <form action="/dashboard/master/pegawai/import" method="POST" enctype="multipart/form-data" class="import-page">
            @csrf
            <input type="file" name="file" class="import-box">
            <i class="fa-solid fa-users-viewfinder"></i>
            <button type="submit" class="evented-btn">Kirim Berkas</button>
            <div class="fake-btn">Klik atau Tarik berkas kedalam area ini</div>
        </form>
    </div>
</div>

@endsection