<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqJabatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sender() {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function approver() {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    public function jadwal() {
        return $this->belongsTo(jadwal_kerja::class, 'jadwal_id');
    }
}
