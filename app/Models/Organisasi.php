<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Request_Donasi;

class Organisasi extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'organisasi';
    protected $primaryKey = 'ID_ORGANISASI';
    public $timestamps = false;

    protected $fillable = [
        'NAMA_ORGANISASI',
        'EMAIL_ORGANISASI',
        'ALAMAT_ORGANISASI',
        'NOTELP_ORGANISASI',
        'PASSWORD_ORGANISASI',
    ];

    protected $hidden = [
        'PASSWORD_ORGANISASI',
    ];

    public function request()
    {
        return $this->hasOne(Request_Donasi::class, 'ID_ORGANISASI');
    }

    public function getAuthPassword()
    {
        return $this->PASSWORD_ORGANISASI;
    }
}
