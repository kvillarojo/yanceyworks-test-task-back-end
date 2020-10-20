<?php

namespace App\Repositories\Company;

interface CompanyRepositoryInterface
{
    public function remove($id);

    public function update($data, $id);

    public function index();

    public function insert($data);

    public function employees();

    public function employeeByCompanyId($id);

    public function removeEmployee($id);

    public function uploadLogo($file, $id);
}
