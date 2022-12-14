<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'deceased_id',
        'payment_type',
        'payer',
        'contact_number',
        'lease_amount',
        'amount',
        'ORNumber',
        'balance',
        'terms_of_payment',
        'remarks',
        'datePaid'
    ];

    public function deceased()
    {
        return $this->hasOne('App\Models\Deceased', 'id', 'deceased_id');
    }
}
