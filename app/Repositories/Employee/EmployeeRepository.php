<?php


namespace App\Repositories\Employee;


use App\Models\CompanyEmployees;
use App\Models\Employees;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    public function __construct(Employees $model)
    {
        parent::__construct($model);
    }

    public function insert($data)
    {
        $this->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);
    }

    public function remove($id)
    {
        $this->model->where('id', $id)
            ->delete();
    }

    public function update($data, $id)
    {
        $this->model->where('id', $id)
            ->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name']
            ]);
    }

    public function index()
    {
        return $this->model->paginate(10);
    }

    public function assignToCompany($data, $id)
    {
        CompanyEmployees::create([
            'company_id' => $data['company_id'],
            'employee_id' => $id
        ]);
    }

}
