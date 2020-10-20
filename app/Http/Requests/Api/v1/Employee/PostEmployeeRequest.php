<?php

namespace App\Http\Requests\Api\v1\Employee;

use Illuminate\Foundation\Http\FormRequest;

class PostEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|String|min:3',
            'last_name' => 'required|String|min:3'
        ];
    }
}
