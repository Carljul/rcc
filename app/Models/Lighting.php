<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lighting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'lightings';

    protected $fillable = [
        'deceased_id',
        'name',
        'dateOfConnection',
        'expiryDate',
        'amount',
        'ORNumber'
    ];

    public function deceased()
    {
        return $this->hasOne('App\Models\Deceased', 'id', 'deceased_id');
    }
}
