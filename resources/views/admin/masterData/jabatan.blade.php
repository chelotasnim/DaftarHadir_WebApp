@extends('admin.layout.master')

@section('admin')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

<div class="data-template">
    <div class="data-content master-template">
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
            @can('manager')
                <div class="controller-box">
                    <div onclick="showModal('4dd', 'new')" class="controller-btn modal-trigger">
                        <i class="fa-solid fa-file-circle-plus"></i>
                        Tambah Jabatan
                    </div>
                </div>
            @endcan
        </div>
        <div class="data-grid master-grid">
            <table id="jabatan">
                <thead>
                    <tr>
                        <th>#</th>
                        @if (empty(Auth::user()->departemen_id))
                            <th class="col-left">Departemen</th>
                        @endif
                        <th class="col-left">Jabatan</th>
                        <th class="col-left">Jadwal Kerja</th>
                        <th>Gaji Perbulan</th>
                        <th>Status</th>
                        @can('manager')
                            <th class="action">*</th>
                        @endcan
                    </tr>
                </thead>
                @livewire('admin.master.show-jabatan')
            </table>
        </div>
    </div>
    @livewire('admin.master.appr-jabatan')
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#jabatan').DataTable();
    } );
</script>   

@endsection