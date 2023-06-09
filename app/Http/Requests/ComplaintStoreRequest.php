<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintStoreRequest extends FormRequest
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
            'content' => ['required', 'max:255', 'string'],
            //'user_id' => ['required', 'exists:users,id'],
            'complaint_type_id' => ['required','exists:complaint_types,id'],
            'municipality_id' => ['exists:municipalities,id'],
        ];
    }
}
