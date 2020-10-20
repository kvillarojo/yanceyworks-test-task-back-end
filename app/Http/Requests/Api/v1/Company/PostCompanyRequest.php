<?php

namespace App\Http\Requests\Api\v1\Company;

use App\Rules\UniqueEmailAddress;
use App\Rules\UniquePhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class PostCompanyRequest extends FormRequest
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
            'name' => 'required|min:3|string',
            'email' => [
                'required',
                'email',
                new UniqueEmailAddress()
            ],
            'phone' => [
                'required',
                new UniquePhoneNumber()
            ]
        ];
    }
}
