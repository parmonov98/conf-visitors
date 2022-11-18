<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVisitorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
//        return response($this->all());
//        dd($this->all());
        return [
            'first_name' => 'required|min:1',
            'last_name' => 'required|min:1',
            'email' => 'required|email|unique:visitors,email',
            'phone' => ['required', 'regex:/^([+]?[\s0-9]+)?(\d{3}|[(]?[0-9]+[)])?([-]?[\s]?[0-9])+$/', 'unique:visitors,phone'],
            'type' => ['required', Rule::in(['guest', 'press','reporter'])],
            'has_paid' => 'nullable|boolean',
            "comment" => "nullable|string"
        ];
    }
}
