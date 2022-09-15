<?php

namespace App\Http\Requests;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DeceasedRequest extends FormRequest
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
        return [];
    }

    /**
     * Validation rules for api
     *
     * @return Array
     */
    public function rulesApi()
    {
        // normalized date validation values
        $dateDiedVal = $this->birthdate ? Carbon::parse($this->birthdate) : Carbon::parse($this->dateDied);
        $intermentDateVal = $this->dateDied ? Carbon::parse($this->dateDied) : Carbon::parse($this->internmentDate);
        $datepaidVal = $this->internmentDate ? Carbon::parse($this->internmentDate) : Carbon::parse($this->datepaid);
        $expiryDateVal = $this->datepaid ? Carbon::parse($this->datepaid) : Carbon::parse($this->expiryDate);

        return [
            'firstname'      => ['required'],
            'birthdate'      => ['nullable', 'sometimes', 'before_or_equal:'. Carbon::now()],
            'dateDied'       => ['nullable', 'sometimes', 'after_or_equal:'. $dateDiedVal],
            'internmentDate' => ['nullable', 'sometimes', 'after_or_equal:'. $intermentDateVal],
            'datepaid'       => ['nullable', 'sometimes', 'after_or_equal:'. $datepaidVal],
            'expiryDate'     => ['nullable', 'sometimes', 'after_or_equal:'. $expiryDateVal]
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
            $response['data'] = $this->all();
            $response['message'] = $validator->errors();
        }

        return $response;
    }

    /**
     * Custom validation message
     *
     * @return Array
     */
    public function messages()
    {
        return [
            'birthdate.before_or_equal'     => ':attribute should be previous or now',
            'dateDied.after_or_equal'      => 'The date died must be a date after or equal to birthdate.',
            'internmentDate.after_or_equal' => 'The internment date must be a date after or equal to date died.',
            'datepaid.after_or_equal'       => 'The date paid date must be a date after or equal to internment date.',
            'expiryDate.after_or_equal'     => 'The expiry date must be a date after or equal to date paid.',
        ];
    }
}
