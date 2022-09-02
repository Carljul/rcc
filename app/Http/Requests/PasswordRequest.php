<?php

namespace App\Http\Requests;

use Auth;
use App\Rules\MatchCurrentPass;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_password'      => ['required', 'max:6', new MatchCurrentPass],
            'password'              => 'required|confirmed|max:6',
            'password_confirmation' => 'required|max:6'
        ];
    }
}
