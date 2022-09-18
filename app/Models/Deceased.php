<?php

namespace App\Models;

use DB;
use Auth;
use Exception;
use App\Models\Person;
use App\Models\Payment;
use App\Models\Lighting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deceased extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'deceased';

    protected $fillable = [
        'person_id',
        'dateDied',
        'internmentDate',
        'internementTime',
        'expiryDate',
        'causeOfDeath',
        'location',
        'vicinity',
        'area',
        'remarks',
        'isApprove',
        'approvedBy',
        'createdBy',
        'updatedBy',
        'deletedBy',
        'deleted_at',
    ];

    public function person()
    {
        return $this->hasOne('App\Models\Person', 'id', 'person_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payment', 'deceased_id', 'id');
    }

    public function lighting()
    {
        return $this->hasMany('App\Models\Lighting', 'deceased_id', 'id');
    }

    public function approvedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'approvedBy');
    }

    public function createdBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'createdBy');
    }

    public function updatedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'updatedBy');
    }

    public function deletedBy()
    {
        return $this->hasOne('App\Models\User', 'id', 'deletedBy');
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

            $data = self::create([
                'person_id' => $person->id,
                'dateDied' => $params['dateDied'],
                'internmentDate' => $params['internmentDate'],
                'internmentTime' => $params['internmentTime'],
                'expiryDate' => $params['expiryDate'],
                'causeOfDeath' => $params['cod'],
                'location' => $params['location'],
                'vicinity' => $params['vicinity'],
                'area' => $params['area'],
                'remarks' => $params['remarks'],
                'isApprove' => array_key_exists('is_approve', $params) ? $params['is_approve'] : 0,
                'createdBy' => Auth::user()->id
            ]);

            $payment = null;
            if (isset($params['amount'])) {
                $payment = Payment::create([
                    'deceased_id' => $data->id,
                    'payment_type' => $params['payment_type'],
                    'payer' => $params['payer'],
                    'contact_number' => $params['contact_number'],
                    'amount' => $params['amount'],
                    'ORNumber' => $params['ornumber'],
                    'balance' => $params['balance'],
                    'terms_of_payment' => $params['terms_of_payment'],
                    'datePaid' => $params['datepaid'],
                    'remarks' => isset($params['remarks']) ? $params['remarks'] : 'Payment'
                ]);
                $payment = $payment->id;
            }

            if (array_key_exists('pasuga_payer', $params)) {
                if (!empty($params['pasuga_payer'])) {
                    Lighting::create([
                        'deceased_id' => $data->id,
                        'name' => $params['pasuga_payer'],
                        'dateOfConnection' => $params['pasuga_date_connection'],
                        'expiryDate' => $params['pasuga_expiry_date'],
                        'amount' => $params['pasuga_amount'],
                        'ORNumber' => $params['pasuga_or_number']
                    ]);
                }
            }

            DB::commit();

            return [
                'error' => false,
                'message' => 'Successfully Saved',
                'data' => []
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

    public static function updater($params)
    {
        DB::beginTransaction();
        try {
            $deceased = self::where('id', $params['id'])->first();
            $person = Person::where('id', $deceased->person_id)->first();

            $person->firstname = $params['firstname'];
            $person->middlename = $params['middlename'];
            $person->lastname = $params['lastname'];
            $person->extension = $params['extension'];
            $person->gender = $params['gender'];
            $person->birthdate = $params['birthdate'];
            $person->address = $params['address'];
            $person->save();

            if (array_key_exists('expiredUpdate', $params)) {
                $deceased->deletedBy = Auth::user()->id;
                $deceased->remarks = $params['remarks'];
                $deceased->updated_at = now();
                $deceased->save();
                $person->delete();
                $deceased->delete();
            } else {
                $deceased->person_id = $person->id;
                $deceased->dateDied = $params['dateDied'];
                $deceased->internmentDate = $params['internmentDate'];
                $deceased->internmentTime = $params['internmentTime'];
                $deceased->expiryDate = $params['expiryDate'];
                $deceased->causeOfDeath = $params['cod'];
                $deceased->location = $params['location'];
                $deceased->vicinity = $params['vicinity'];
                $deceased->area = $params['area'];
                $deceased->remarks = $params['viewRemarks'];
                $deceased->updatedBy = Auth::user()->id;
                $deceased->save();
            }

            DB::commit();
            return [
                'error' => false,
                'message' => 'Updated',
                'data' => []
            ];
        } catch (\Exception $e) {
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
            ->with('payment')
            ->with('approvedBy')
            ->with('createdBy')
            ->with('updatedBy')
            ->with('deletedBy')
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

            $deceased->deletedBy = Auth::user()->id;
            $deceased->save();

            $deceased->delete();

            // Note do not delete payment record

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

    public static function expired($year, $month)
    {
        if ($month == 0) {
            return self::whereYear('expiryDate', $year)
                ->with('person')
                ->with('payment')
                ->with('lighting')
                ->get();
        }

        return self::whereYear('expiryDate', $year)
            ->whereMonth('expiryDate', $month)
            ->with('person')
            ->with('payment')
            ->with('lighting')
            ->get();
    }

    public static function deletedR()
    {
        return self::onlyTrashed()
            ->with(['person' => function ($query) {
                $query->onlyTrashed();
            }])
            ->with('payment')
            ->with('approvedBy')
            ->with('createdBy')
            ->with('updatedBy')
            ->with('deletedBy')
            ->get();
    }
}
