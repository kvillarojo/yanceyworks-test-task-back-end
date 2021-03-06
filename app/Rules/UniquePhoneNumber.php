<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniquePhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (new \App\Models\Companies)->hasPhoneNumber($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Phone number already in use.';
    }

}
