@extends('admin.layout.master')

@section('admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

<div class="data-template">
    @livewire('admin.dashboard.aktivitas-statistic')
    <div class="data-content">
        <div class="data-controller">
            <div class="controller-role">
                @can('manager')
                    <i class="fa-solid fa-user-gear"></i>
                @endcan
                @can('observer')
                    <i class="fa-solid fa-user-secret"></i>
                @endcan
                {{ Auth::user()->peran }}
            </div>
            <div class="controller-date">
                Data per tanggal : <span>{{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</span>
            </div>
            @can('manager')
                <div class="controller-box">
                    <div onclick="showModal('4dd', 'new')" class="controller-btn modal-trigger evented-btn">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        Tambah Aktivitas
                    </div>
                </div>
            @endcan
        </div>
        <div class="data-grid">
            <table id="aktivitas">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-left">Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Aktivitas</th>
                        <th class="col-left">Keterangan</th>
                        @can('manager')
                            <th>*</th>
                        @endcan
                    </tr>
                </thead>
                @livewire('admin.dashboard.show-aktivitas-pegawai')
            </table>
        </div>
    </div>
    @livewire('admin.dashboard.appr-aktivitas')
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#aktivitas').DataTable({
            scrollX: true
        });
    } );
</script>   
@endsection