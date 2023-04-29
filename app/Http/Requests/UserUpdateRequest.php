<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
       // dd($this->user()->id);
        return [
           // 'name' => ['required', 'max:255', 'string'],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user()->id),
                'email',
            ],
            'password' => ['nullable'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
            'phone' => ['required',
                Rule::unique('users', 'phone')->ignore($this->user()->id),
                'max:255', 'string'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:أنثى,ذكر'],
            'nationality' => ['required', 'max:255', 'string'],
            'Identity' => ['required', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
            'roles' => 'array',
        ];
    }
}
