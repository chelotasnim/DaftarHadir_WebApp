<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Lembur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LemburStatistic extends Component
{
    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $totalLembur = Lembur::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->count();
            $preview_param = 'all';
        } else {
            $totalLembur = Lembur::where('departemen_id', Auth::user()->departemen_id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->count();
            $preview_param = Auth::user()->departemen_id;
        };

        return view('livewire.admin.dashboard.lembur-statistic', [
            'lembur' => $totalLembur,
            'preview_param' => $preview_param
        ]);
    }
}
