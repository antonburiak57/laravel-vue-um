<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'degree' => 'required',
            'street' => 'required',
            'street_no' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'password' => 'required'
        ];
    }
}
