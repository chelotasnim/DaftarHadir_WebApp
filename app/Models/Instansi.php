<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function users() {
        return $this->hasMany(User::class, 'perusahaan_id');
    }

    public function departemens() {
        return $this->hasMany(Departemen::class, 'perusahaan_id');
    }

    public function izins() {
        return $this->hasMany(Izin::class, 'perusahaan_id');
    }

    public function liburNasional() {
        return $this->hasMany(LiburNasional::class, 'perusahaan_id');
    }
}
