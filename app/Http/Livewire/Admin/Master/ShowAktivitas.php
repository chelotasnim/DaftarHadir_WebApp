<?php

namespace App\Http\Livewire\Admin\Master;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowAktivitas extends Component
{
    public function render()
    {
        return view('livewire.admin.master.show-aktivitas', [
            'departemens' => Auth::user()->instansi->departemens
        ]);
    }
}
