<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'inquiry_date' => ['required', 'date'],
            'client_id' => ['required', 'exists:clients,id'],
        ];
    }

    public function messages() {
        return [
            'inquiry_date.required' => 'The field Inquire Date is required',
            'inquiry_date.date' => 'Wrong Inquire Date format',
            'client_id.required' => 'The field Contact is required',
            'client_id.exists' => 'The Contact does not exist',
        ];
    }
}
