<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function instansi() {
        return $this->belongsTo(Instansi::class, 'perusahaan_id');
    }

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function reqDepartemens() {
        return $this->hasMany(ReqDepartemen::class, 'pengirim_id');
    }

    public function reqJadwal() {
        return $this->hasMany(ReqJadwal::class, 'pengirim_id');
    }

    public function reqJabatan() {
        return $this->hasMany(ReqJabatan::class, 'pengirim_id');
    }

    public function reqPegawai() {
        return $this->hasMany(ReqPegawai::class, 'pengirim_id');
    }

    public function reqAdmin() {
        return $this->hasMany(ReqAdmin::class, 'pengirim_id');
    }

    public function reqIzins() {
        return $this->hasMany(ReqIzin::class, 'pengirim_id');
    }

    public function reqPresensi() {
        return $this->hasMany(ReqPresensi::class, 'pengirim_id');
    }

    public function reqIzinPresensi() {
        return $this->hasMany(ReqIzinPresensi::class, 'pengirim_id');
    }

    public function reqLiburNasional() {
        return $this->hasMany(ReqLiburNasional::class, 'pengirim_id');
    }

    public function reqLiburKhusus() {
        return $this->hasMany(ReqLiburKhusus::class, 'pengirim_id');
    }

    public function reqAktivitas() {
        return $this->hasMany(ReqAktivitas::class, 'pengirim_id');
    }

    public function reqAktivitasPegawai() {
        return $this->hasMany(ReqAktivitasPegawai::class, 'pengirim_id');
    }

    public function reqLembur() {
        return $this->hasMany(ReqLembur::class, 'pengirim_id');
    }

    public function changeLog() {
        return $this->hasMany(ChangeLog::class, 'operator_id');
    }

    public function dashboardUi() {
        return $this->hasMany(DashboardSetting::class, 'user_id');
    }

    public function autonotif() {
        return $this->hasOne(Autonotif::class, 'admin_id');
    }
}
