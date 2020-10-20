<?php

namespace App\Repositories\CompanyEmployees;

interface CompanyEmployeeRepositoryInterface
{
    public function store($employee_id, $company_id);

    public function update($employee_id, $company_id);

    public function remove($id);
}
