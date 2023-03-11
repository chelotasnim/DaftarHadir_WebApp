@extends('admin.layout.master')

@section('admin')

<div class="data-template" style="height: 100%">
    <div class="data-content" style="position: absolute; height: 100%; width: 100%; margin-top: 0">
        <form action="/dashboard/master/pegawai/import" method="POST" enctype="multipart/form-data" class="import-page">
            @csrf
            <input type="file" name="file">
            <i class="fa-solid fa-users-viewfinder"></i>
            <button type="submit" class="evented-btn">Kirim Data</button>
        </form>
    </div>
</div>

@endsection