<?php

namespace App\Repositories\CompanyEmployees;

interface CompanyEmployeeRepositoryInterface
{
    /**
     * @param $employee_id
     * @param $company_id
     */
    public function store($employee_id, $company_id);

    /**
     * @param $employee_id
     * @param $company_id
     */
    public function update($employee_id, $company_id);

    /**
     * @param $id
     */
    public function remove($id);
}
