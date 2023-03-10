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

namespace App\Http\Livewire\Wizard;

use App\Models\DashboardSetting;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class StartForm extends Component
{
    // Slide Stabilizer
    public $stabilizer = false;

    // Agency Datas
    public $nama_instansi;
    public $deskripsi_instansi;
    public $alamat_instansi;
    public $kontak_instansi;
    public $website_instansi;
    public $type;
    public $hari_kerja;
    public $type_jadwal;
    public $smart_wages;

    // Agency Manager Datas
    public $name;
    public $password;
    
    public function render()
    {
        return view('livewire.wizard.start-form', [
            'user' => Auth::user()
        ]);
    }

    public function create()
    {
        $this->stabilizer = true;

        // Create New Agency
        $newAgency = $this->validate([
            'nama_instansi' => 'required|min:5|max:50|unique:instansis',
            'deskripsi_instansi' => 'required|min:100|max:255',
            'alamat_instansi' => 'required|min:12|max:100',
            'kontak_instansi' => 'required',
            'type' => 'required',
            'hari_kerja' => 'required',
            'type_jadwal' => 'required',
        ]);
        $newAgency['smart_wages'] = $this->smart_wages;
        $newAgency['website_instansi'] = $this->website_instansi;

        // Create New Manager        
        $newManager = $this->validate([
            'name' => 'required|min:8|max:25|unique:users',
            'password' => 'required|min:8|max:16'
        ]); 

        Instansi::create($newAgency);

        // Get Agency ID
        $agencyID = Instansi::where('nama_instansi', $newAgency['nama_instansi'])->select('id')->get();

        $newManager['perusahaan_id'] = $agencyID[0]->id;
        $newManager['password'] = Hash::make($newManager['password']);
        $newManager['peran'] = 'Pengelola Utama';
        $newManager['status'] = 'Aktif';

        User::create($newManager);

        $get_new_manager = User::where('perusahaan_id', $newManager['perusahaan_id'])->where('peran', $newManager['peran'])->select('id')->get();
        $manager_ui['user_id'] = $get_new_manager[0]->id;
        $manager_ui['quick_setting'] = 'HighBlob';
        $manager_ui['theme'] = 'blue-page';
        $manager_ui['blob'] = true;
        $manager_ui['shadow'] = true;
        $manager_ui['filter'] = true;
        $manager_ui['transition'] = true;

        DashboardSetting::create($manager_ui);

        // Activate License
        $userID = Auth::user()->id;
        User::where('id', $userID)->update([
            'perusahaan_id' => $agencyID[0]->id,
            'status' => 'Aktif'
        ]);

        $manager_ui['user_id'] = Auth::user()->id;

        DashboardSetting::create($manager_ui);

        return redirect('/dashboard');
    }
}
