<?php


namespace App\Repositories\Employee;


use App\Models\Companies;
use App\Models\CompanyEmployees;
use App\Models\Employees;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    /**
     * EmployeeRepository constructor.
     * @param Employees $model
     */
    public function __construct(Employees $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $data
     */
    public function insert($data)
    {
        $this->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name']
        ]);
    }

    /**
     * @param $id
     */
    public function remove($id)
    {
        $this->model->where('id', $id)
            ->delete();
    }

    /**
     * @param $data
     * @param $id
     */
    public function update($data, $id)
    {
        $this->model->where('id', $id)
            ->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name']
            ]);
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->model->paginate(10);
    }

    /**
     * @param $data
     * @param $id
     */
    public function assignToCompany($data, $id)
    {
        CompanyEmployees::create([
            'company_id' => $data['company_id'],
            'employee_id' => $id
        ]);
    }

    public function employeeWithCompany()
    {
        return DB::table('companies')
            ->select(DB::raw('employees.id, employees.first_name, employees.last_name, if(isnull(companies.name), "", companies.name) as "company"'))
            ->leftJoin('company_employees', 'companies.id', 'company_employees.company_id')
            ->rightJoin('employees', 'company_employees.employee_id', '=', 'employees.id')
            ->paginate(10);
    }

}
