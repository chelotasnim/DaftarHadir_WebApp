<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqJadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function departemen() {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function sender() {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function approver() {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function details() {
        return $this->hasMany(ReqJadwalDetail::class, 'jadwal_kerja_id');
    }
}
