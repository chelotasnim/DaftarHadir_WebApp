@extends('admin.layout.master')

@section('admin')

    <div class="data-template chat-template">
        <div class="data-content">
            @livewire('admin.dashboard.chat-pegawai')
        </div>
    </div>

@endsection