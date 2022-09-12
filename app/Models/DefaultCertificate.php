<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultCertificate extends Model
{
    use HasFactory;

    protected $table = 'rcc_defaults';

    protected $fillable = [
        'cemetery_administrator',
        'parish_office_staff',
        'parish_team_moderator',
        'parish_team_member',
    ];
}
