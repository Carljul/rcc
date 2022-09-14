<?php

namespace App\Http\Requests;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LightingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation rules that apply to the request (for api).
     *
     * @return array
     */
    public function rulesApi()
    {
        $nextYear = Carbon::now()->addYear(1);
        $nextYear = $nextYear->setMonth(1);
        $nextYear = $nextYear->setDay(1);
        return [
            'dateOfConnection' => ['after_or_equal:'.Carbon::now(), 'before:'.$nextYear],
            'expiryDate'       => ['after:'.Carbon::parse($this->dateOfConnection), 'before:'.$nextYear],
        ];
    }

    /**
     * Api validator (get error response)
     *
     * @return Array
     */
    public function validateApi()
    {
        $response['error'] = false;
        $response['message'] = null;
        $validator = Validator::make($this->all(), $this->rulesApi(), $this->messages());
        if ($validator->fails()) {
            $response['error'] = true;
            $response['message'] = $validator->errors();
        }

        return $response;
    }

    /**
     * Custom messages
     *
     * @return Array
     */
    public function messages()
    {
        return [
            'expiryDate.after'                => 'The expiry date must be a date after date of connection.',
            'dateOfConnection.after_or_equal' => 'The date of connection must be a date after or equal to date today.',
            'expiryDate.before'               => 'The expiry date must be a date within the year',
            'dateOfConnection.before'         => 'The date of connection must be a date within the year',
        ];
    }
}
