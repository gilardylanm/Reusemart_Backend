<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Owner extends Model
{
    use HasFactory;
    protected $table = 'owner';
    protected $primaryKey = 'ID_OWNER';
    public $timestamps = false;

    protected $fillable = [
        'EMAIL_OWNER',
        'PASSWORD_OWNER',
    ];

    protected $hidden = [
        'PASSWORD_ORGANISASI',
    ];
}
