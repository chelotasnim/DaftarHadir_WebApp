<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jabatan() {
        return $this->belongsTo(jabatan::class, 'jabatan_id');
    }

    public function presensi() {
        return $this->hasMany(Presensi::class, 'pegawai_id');
    }

    public function izin() {
        return $this->hasMany(IzinPresensi::class, 'pegawai_id');
    }

    public function aktivitas() {
        return $this->hasMany(AktivitasPegawai::class, 'pegawai_id');
    }

    public function lembur() {
        return $this->hasMany(Lembur::class, 'pegawai_id');
    }
}
