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

                <div class="controller-box">

                    <div onclick="showModal('4dd', 'new')" class="controller-btn modal-trigger">

                        <i class="fa-solid fa-file-circle-plus"></i>

                        Tambah Admin

                    </div>

                </div>

        </div>

        <div class="data-grid master-grid">

            <table id="admin">

                <thead>

                    <tr>

                        <th>#</th>

                        <th class="col-left">Username</th>

                        <th class="col-left">Nama Pegawai</th>

                        <th class="col-left">Departemen</th>

                        <th class="col-left">Jabatan</th>

                        <th>Peran</th>

                        <th>Status</th>

                            <th class="action">*</th>

                    </tr>

                </thead>

                @livewire('admin.master.show-admin')

            </table>

        </div>

    </div>

    @livewire('admin.master.appr-admin')

</div>



<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

<script>

    $(document).ready( function () {

        $('#admin').DataTable({
            pageLength: 'All',
            
            paging: false
        });

    } );

</script>   



@endsection