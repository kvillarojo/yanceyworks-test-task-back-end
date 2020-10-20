<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends BaseModel
{

    public function employees()
    {
        return $this->belongsToMany(
            'App\Models\Employees',
            'company_employees',
            'company_id',
            'employee_id'
        );
    }

    public function hasEmail($value)
    {
        return !$this->where('email', $value)->exists();
    }

    public function hasPhoneNumber($value)
    {
        return !$this->where('phone', $value)->exists();
    }


}
