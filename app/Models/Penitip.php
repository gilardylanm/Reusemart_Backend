<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TopSeller;

class Penitip extends Authenticatable
{
    use HasFactory;
    protected $table = 'penitip';
    protected $primaryKey = 'ID_PENITIP';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_PENITIP',
        'EMAIL_PENITIP',
        'ALAMAT_PENITIP',
        'NOTELP_PENITIP',
        'NIK',
        'SCAN_KTP',
        'PASSWORD_PENITIP',
        'SALDO_PENITIP',
        'POIN_PENITIP',
    ];

    protected $hidden = [
        'PASSWORD_PENITIP',
    ];

    public function getAuthPassword()
    {
        return $this->PASSWORD_PENITIP;
    }

    public function topseller()
    {
        return $this->belongsTo(TopSeller::class);
    }

    public function penitipan()
    {
        return $this->hasMany(Penitipan::class);
    }
}