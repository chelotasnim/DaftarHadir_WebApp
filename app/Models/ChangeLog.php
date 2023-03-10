<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function operator() {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function approver() {
        return $this->belongsTo(User::class, 'acc_id');
    }
}
