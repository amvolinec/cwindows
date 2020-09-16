<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
            'offer_id' => 'required',
            'manager_id' => 'required',
            'state_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'offer_id.required' => 'Select Offer, please',
            'state_id.required' => 'Select state, please',
            'manager_id.required' => 'Select Manager, please',
        ];
    }
}
