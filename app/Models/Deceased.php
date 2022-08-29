<?php

namespace App\Models;

use DB;
use Exception;
use App\Models\Person;
use App\Models\Payment;
use App\Models\Relative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deceased extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'deceased';

    protected $fillable = [
        'person_id',
        'relative_id',
        'dateDied',
        'internmentDate',
        'internementTime',
        'expiryDate',
        'causeOfDeath',
        'location',
    ];

    public function person()
    {
        return $this->hasOne('App\Models\Person', 'id', 'person_id');
    }

    public function relative()
    {
        return $this->hasOne('App\Models\Relative', 'id', 'relative_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\Payment', 'id', 'payment_id');
    }

    public static function register($params)
    {
        DB::beginTransaction();
        try {
            $person = Person::create([
                'firstname' => $params['firstname'],
                'middlename' => $params['middlename'],
                'lastname' => $params['lastname'],
                'extension' => $params['extension'],
                'gender' => $params['gender'] != 'null' ? $params['gender']:null,
                'birthdate' => $params['birthdate'],
                'address' => $params['address']
            ]);

            $relative = null;
            if (isset($params['relativeFirstname'])) {
                $relative = Relative::create([
                    'firstname' => $params['relativeFirstname'],
                    'middlename' => $params['relativeMiddlename'],
                    'lastname' => $params['relativeLastname'],
                    'contact_number' => $params['relativeContactNumber']
                ]);
            }

            $payment = null;
            if (isset($params['amount'])) {
                $payment = Payment::create([
                    'amount' => $params['amount'],
                    'ORNumber' => $params['ornumber'],
                    'datePaid' => $params['datepaid']
                ]);
            }

            $data = self::create([
                'person_id' => $person->id,
                'relative_id' => empty($relative) ? $relative : $relative->id,
                'payment_id' => empty($payment) ? $payment : $payment->id,
                'dateDied' => $params['dateDied'],
                'internmentDate' => $params['internmentDate'],
                'internmentTime' => $params['internmentTime'],
                'expiryDate' => $params['expiryDate'],
                'causeOfDeath' => $params['cod'],
                'location' => $params['location']
            ]);

            DB::commit();

            return [
                'error' => false,
                'message' => 'Successfully Saved',
                'data' => self::show($data->id)
            ];
        } catch (Exception $e) {
            \Log::error(get_class().' '.$e);

            DB::rollback();

            return [
                'error' => true,
                'message' => 'Something went wrong',
                'data' => []
            ];
        }
    }

    public static function show($id)
    {
        return self::where('id', $id)
            ->whereNull('deleted_at')
            ->with('person')
            ->with('relative')
            ->with('payment')
            ->get();
    }

    public static function destroyRecord($id)
    {
        DB::beginTransaction();
        try {
            $deceased = self::where('id', $id)->first();

            if (!empty($deceased->person_id)) {
                $person = Person::find($deceased->person_id);
                $person->delete();
            }

            if (!empty($deceased->relative_id)) {
                $person = Relative::find($deceased->person_id);
                $person->delete();
            }

            $deceased->delete();

            DB::commit();

            return [
                'error' => false,
                'message' => 'Deleted'
            ];
        } catch (Exception $e) {
            \Log::error(get_class().' '.$e);

            DB::rollback();

            return [
                'error' => true,
                'message' => 'Something went wrong'
            ];
        }
    }
}
