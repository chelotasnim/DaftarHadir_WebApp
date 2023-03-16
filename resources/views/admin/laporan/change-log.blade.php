@extends('admin.layout.master')

@section('admin')

    <div class="data-template">
        <div class="req-card-container" style="gap: 116px 16px">
            @foreach ($changeLogs as $log)
                <div class="log-card">
                    <div class="card-head">
                        <i class="fa-solid fa-user-gear"></i>
                        {{ $log->operator->name }}
                    </div>
                    <div class="card-content">
                        <div class="card-list-wrapper">
                            <div class="card-info acc-admin">
                                <i class="fa-solid fa-user-secret"></i>
                                {{ $log->approver->name }} - {{ $log->created_at->format('h:i') }} WIB
                            </div>
                            <div class="card-info date">
                                {{ $log->created_at->isoFormat('dddd, D MMMM Y') }}
                            </div>
                            <span class="as-label">{{ $log->jenis_perubahan }}</span>
                            <p>{{ $log->perubahan }}</p>
                            <span class="as-label keterangan">Keterangan</span>
                            <p>
                                {{ $log->keterangan }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection