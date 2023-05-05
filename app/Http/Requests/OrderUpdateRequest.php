<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'status' => ['required', 'in:إنتظار,قبول,رفض'],

            'order_type_id' => ['required', 'exists:order_types,id'],
            'user_id' => ['required', 'exists:users,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ];
    }
}
