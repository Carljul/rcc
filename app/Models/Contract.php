<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'deceased_id',
        'payment_id',
        'reports_id',
        'lessee',
        'niche_identification_number',
        'contract_number',
        'address',
        'remarks'
    ];

    public function payment()
    {
        return $this->hasOne('App\Models\Payment', 'id', 'payment_id');
    }
    public function deceased()
    {
        return $this->hasOne('App\Models\Deceased', 'id', 'deceased_id');
    }
}
