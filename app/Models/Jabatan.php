<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function departemen() {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function jadwal() {
        return $this->belongsTo(jadwal_kerja::class, 'jadwal_id');
    }

    public function pegawais() {
        return $this->hasMany(Pegawai::class, 'jabatan_id');
    }
}
