<?php

namespace App\Repositories\Employee;

interface EmployeeRepositoryInterface
{
    public function insert($data);

    public function remove($id);

    public function update($data, $id);

    public function index();

    public function employeeWithCompany();
}
