<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_kerja extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function departemen() {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function details() {
        return $this->hasMany(Jadwal_detail::class, 'jadwal_kerja_id');
    }

    public function jabatans() {
        return $this->hasMany(Jabatan::class, 'jadwal_id');
    }
}
