<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autonotif extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function templates() {
        return $this->hasMany(AutonotifTemplate::class, 'autonotif_id');
    }
}
