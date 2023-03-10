<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function perusahaan() {
        return $this->belongsTo(Instansi::class, 'perusahaan_id');
    }

    public function jadwals() {
        return $this->hasMany(jadwal_kerja::class, 'departemen_id');
    }

    public function liburKhusus() {
        return $this->hasMany(LiburKhusus::class, 'departemen_id');
    }

    public function aktivitas() {
        return $this->hasMany(Aktivitas::class, 'departemen_id');
    }
}
