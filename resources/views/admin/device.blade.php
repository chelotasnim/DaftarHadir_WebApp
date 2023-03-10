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
        </div>
        <div class="data-grid master-grid">
            <table id="device">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="col-left">Serial Number</th>
                        <th>IP</th>
                        <th>Last Activity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $device)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="col-left">{{ $device->SN }}</td>
                            <td>{{ $device->IPAddress }}</td>
                            <td>{{ $device->LastActivity }}</td>
                            <td>
                                @if ($device->State == 1)
                                    <span class="as-label green">Online</span>
                                @else 
                                    <span class="as-label red">Offline</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#device').DataTable();
    } );
</script>   

@endsection