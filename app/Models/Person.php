<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'person';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'extension',
        'gender',
        'birthdate',
        'address'
    ];
}
