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
        return [
            'firstname'      => ['required'],
            'birthdate'      => ['nullable', 'sometimes', 'before_or_equal:'.Carbon::now()],
            'dateDied'       => ['nullable', 'sometimes', 'before_or_equal:'.Carbon::parse($this->birthdate)],
            'internmentDate' => ['nullable', 'sometimes', 'after_or_equal:'. Carbon::parse($this->dateDied) ],
            'datepaid'       => ['nullable', 'sometimes', 'after_or_equal:'.Carbon::parse($this->internmentDate)],
            'expiryDate'     => ['nullable', 'sometimes', 'after_or_equal:'.Carbon::parse($this->datepaid)]
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
     * Custom validation message
     *
     * @return Array
     */
    public function messages()
    {
        return [
            'birthdate.before_or_equal'     => ':attribute should be previous or now',
            'dateDied.before_or_equal'      => 'The date died must be a date before or equal to birthdate.',
            'internmentDate.after_or_equal' => 'The internment date must be a date after or equal to date died.',
            'datepaid.after_or_equal'       => 'The date paid date must be a date after or equal to internment date.',
            'expiryDate.after_or_equal'     => 'The expiry date must be a date after or equal to date paid.',
        ];
    }
}
