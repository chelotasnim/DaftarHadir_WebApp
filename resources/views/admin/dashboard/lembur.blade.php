@extends('admin.layout.master')



@section('admin')



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">



<div class="data-template">

    @livewire('admin.dashboard.lembur-statistic')

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

                <div class="controller-box">

                    <div onclick="showModal('4dd', 'new')" class="controller-btn modal-trigger evented-btn">

                        <i class="fa-solid fa-file-circle-plus"></i>

                        Ajukan Lembur

                    </div>

                </div>

        </div>

        <div class="data-grid">

            <table id="lembur">

                <thead>

                    <tr>

                        <th>#</th>

                        <th class="col-left">Nama Pegawai</th>

                        @can('highOfficer')

                            <th class="col-left">Departemen</th>

                        @endcan

                        <th>Tanggal</th>

                        <th>Mulai</th>

                        <th>Selesai</th>

                        <th class="col-left" style="min-width: 45%">Keterangan</th>

                        @can('manager')

                            <td>*</td>

                        @endcan

                    </tr>

                </thead>

                @livewire('admin.dashboard.show-lembur')

            </table>

        </div>

    </div>

    @livewire('admin.dashboard.appr-lembur')

</div>



<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>

    $(document).ready( function () {

        $('#lembur').DataTable({

            scrollX: true,

            pageLength: 'All',
            
            paging: false

        });

    } );

</script>   

@endsection