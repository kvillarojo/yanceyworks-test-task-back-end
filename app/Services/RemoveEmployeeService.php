<?php


namespace App\Services;


use App\Exceptions\DataConflictException;
use App\Models\CompanyEmployees;
use App\Repositories\Employee\EmployeeRepositoryInterface;

class RemoveEmployeeService
{
    /**
     * @var CompanyEmployees
     */
    private $employeeInterface;

    /**
     * RemoveEmployeeService constructor.
     * @param EmployeeRepositoryInterface $employeeInterface
     */
    public function __construct(EmployeeRepositoryInterface $employeeInterface)
    {
        $this->employeeInterface = $employeeInterface;
    }

    /**
     * @param $id
     * @throws DataConflictException
     */
    public function remove($id)
    {
        $exist = CompanyEmployees::where('employee_id', $id)
            ->exists();

        if($exist) {
            throw new DataConflictException('Unable to remove, employee is under company.');
        }

        $this->employeeInterface->remove($id);
    }
}
