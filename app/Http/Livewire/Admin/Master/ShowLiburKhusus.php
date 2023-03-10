<?php

/**
 * Dear Maintainer
 * 
 * When I wrote this code
 * Only God and I know what it was
 * Now, only God know what it was :)
 * 
 * Stay Tawakal and Keep Ikhtiar
 * May god give you clue about it
 * 
 * Recent Maintainer :
 * SMKN 1 Bondowoso 2022/2023 Students
**/

namespace App\Http\Livewire\Admin\Master;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowLiburKhusus extends Component
{
    public function render()
    {
        return view('livewire.admin.master.show-libur-khusus', [
            'departemens' => Auth::user()->instansi->departemens
        ]);
    }
}
