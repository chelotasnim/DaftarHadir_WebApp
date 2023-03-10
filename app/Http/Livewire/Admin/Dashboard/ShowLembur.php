<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Lembur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowLembur extends Component
{
    public function render()
    {
        if(empty(Auth::user()->departemen_id)) {
            $lembur = Lembur::where('perusahaan_id', Auth::user()->instansi->id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get();
        } else {
            $lembur = Lembur::where('departemen_id', Auth::user()->departemen_id)->whereDate('tanggal', Carbon::now()->format('Y-m-d'))->get();
        };

        return view('livewire.admin.dashboard.show-lembur', [
            'lemburs' => $lembur
        ]);
    }
}
