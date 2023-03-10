<?php

namespace App\Http\Livewire\Admin\Master;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.master.show-admin', [
            'admins' => Auth::user()->instansi->users
        ]);
    }
}
