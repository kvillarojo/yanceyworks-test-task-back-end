<?php


namespace App\Repositories\CompanyEmployees;

use App\Models\CompanyEmployees;
use App\Repositories\BaseRepository;

class CompanyEmployeeRepository extends BaseRepository implements CompanyEmployeeRepositoryInterface
{
    /**
     * CompanyEmployeeRepository constructor.
     * @param CompanyEmployees $model
     */
    public function __construct(CompanyEmployees $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $employee_id
     * @param $company_id
     */
    public function store($employee_id, $company_id)
    {
        $this->model->create([
            'company_id' => $company_id,
            'employee_id' => $employee_id
        ]);
    }

    /**
     * @param $employee_id
     * @param $company_id
     */
    public function update($employee_id, $company_id)
    {
        $this->model->where('employee_id', $employee_id)
            ->update([
                'company_id' => $company_id
            ]);
    }

    /**
     * @param $id
     */
    public function remove($id) {
        $this->model->where('id')
            ->delete();
    }
}
