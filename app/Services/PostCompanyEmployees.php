<?php


namespace App\Services;


use App\Exceptions\DataConflictException;
use App\Models\CompanyEmployees;
use App\Repositories\CompanyEmployees\CompanyEmployeeRepositoryInterface;

class PostCompanyEmployees
{
    /**
     * @var CompanyEmployeeRepositoryInterface
     */
    private $companyEmpInterface;

    public function __construct(CompanyEmployeeRepositoryInterface $companyEmpInterface)
    {
        $this->companyEmpInterface = $companyEmpInterface;
    }

    public function newEmployee($com_id, $emp_id)
    {
        $exist = CompanyEmployees::where([
            ['employee_id', '=', $emp_id],
            ['company_id', '=', $com_id]
        ])->exists();

        if ($exist) {
            throw new DataConflictException('Company employee already exist.');
        }

        $this->companyEmpInterface->store($emp_id, $com_id);
    }
}
