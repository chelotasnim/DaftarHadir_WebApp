@extends('admin.layout.master')



@section('admin')



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">



<div class="data-template">

    @livewire('admin.dashboard.izin-presensi-statistic')

    <div class="data-content izin">

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

                Menampilkan semua data izin

            </div>

                <div class="controller-box">

                    <div onclick="showModal('4dd', 'new')" class="affect-on-image evented-btn controller-btn modal-trigger">

                        <i class="fa-solid fa-file-circle-plus"></i>

                        Tambah Izin

                    </div>

                </div>

        </div>

        <div class="data-grid">

            <table id="izin">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>NIP</th>

                        <th class="col-left">Nama Pegawai</th>

                        @can('highOfficer')

                            <th class="col-left">Departemen</th>

                        @endcan

                        <th>Tanggal</th>

                        <th>Keterangan</th>

                        <th style="min-width: 45%">Lampiran</th>

                            <th class="action">*</th>

                    </tr>

                </thead>

                @livewire('admin.dashboard.show-izin-presensi')

            </table>

        </div>

    </div>

    @livewire('admin.dashboard.appr-izin-presensi')

</div>



<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>

    $(document).ready( function () {

        $('#izin').DataTable({

            scrollX: true,

            pageLength: 'All',

            paging: false

        });

    } );

</script>   

@endsection