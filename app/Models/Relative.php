<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Relative extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'relative';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'contact_number'
    ];
}
