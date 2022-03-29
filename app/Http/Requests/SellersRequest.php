<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellersRequest extends FormRequest
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
        $rules = [
            'type_seller' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'document' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'discount' => 'required',
            'advisor_permit' => 'required',
        ];

        return $rules;
    }
}
