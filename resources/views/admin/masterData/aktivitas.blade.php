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

                        Tambah Jenis Aktivitas

                    </div>

                </div>

            @endcan

        </div>

        <div class="data-grid master-grid">

            <table id="aktivitas">

                <thead>

                    <tr>

                        <th>#</th>

                        @can('highOfficer')

                            <th class="col-left">Departemen</th>

                        @endcan

                        <th class="col-left">Aktivitas</th>

                        <th>Status</th>

                        @can('manager')

                            <th class="action">*</th>

                        @endcan

                    </tr>

                </thead>

                @livewire('admin.master.show-aktivitas')

            </table>

        </div>

    </div>

    @livewire('admin.master.appr-aktivitas')

</div>



<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>

    $(document).ready( function () {

        $('#aktivitas').DataTable({
            pageLength: 'All',
            
            paging: false
        });

    } );

</script>   



@endsection