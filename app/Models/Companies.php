<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends BaseModel
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(
            'App\Models\Employees',
            'company_employees',
            'company_id',
            'employee_id'
        );
    }

    /**
     * @param $value
     * @return bool
     */
    public function hasEmail($value)
    {
        return !$this->where('email', $value)->exists();
    }

    /**
     * @param $value
     * @return bool
     */
    public function hasPhoneNumber($value)
    {
        return !$this->where('phone', $value)->exists();
    }

}
