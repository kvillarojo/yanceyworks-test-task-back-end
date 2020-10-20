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

    /**
     * PostCompanyEmployees constructor.
     * @param CompanyEmployeeRepositoryInterface $companyEmpInterface
     */
    public function __construct(CompanyEmployeeRepositoryInterface $companyEmpInterface)
    {
        $this->companyEmpInterface = $companyEmpInterface;
    }

    /**
     * @param $com_id
     * @param $emp_id
     * @throws DataConflictException
     */
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
