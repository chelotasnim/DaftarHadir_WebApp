<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReqDepartemen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sender() {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function approver() {
        return $this->belongsTo(User::class, 'penerima_id');
    }
}
