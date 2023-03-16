@extends('admin.layout.master')

@section('admin')
    <div class="statistic-page">
        <div class="statistic-col">
            @livewire('admin.dashboard.header-stat')
            <div class="big-chart">
                <div class="big-chart-header">
                    <div class="chart-title">
                        <h5>Riwayat Kehadiran {{ \Carbon\Carbon::now()->isoFormat('MMMM Y') }}</h5>
                        <span>
                            @if ((int)\Carbon\Carbon::now()->format('d') - 6 < 1)
                                @if(\Carbon\Carbon::parse(\Carbon\Carbon::now()->format('Y-m') . '-1')->isoFormat('dddd, D MMMM Y') == \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y'))
                                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                                @else
                                    {{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->format('Y-m') . '-1')->isoFormat('dddd, D MMMM Y') }} </span> - s.d - <span> {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                                @endif
                            @else 
                                {{ \Carbon\Carbon::now()->subDays(6)->isoFormat('dddd, D MMMM Y') }}</span> - s.d - <span>{{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                            @endif
                        </span>
                    </div>
                    <div class="chart-filter">
                        <div class="filter-box evented-btn">
                            Lihat Grafik Alpha
                        </div>
                    </div>
                </div>
                @livewire('admin.dashboard.chart-graphic')
            </div>      
        </div>
        <div class="statistic-col">
            @livewire('admin.dashboard.donut-chart')
        </div>
    </div>
    <div class="statistic-page" style="margin-top: 48px">
        <table class="statistic-table">
            <thead>
                <tr>
                    <th class="col-image">Performa</th>
                    <th>Nama</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th class="col-center">Terlambat</th>
                    <th class="col-center">Alpha</th>
                </tr>
            </thead>
            @livewire('admin.dashboard.pegawai-rank')
        </table>
    </div>
@endsection