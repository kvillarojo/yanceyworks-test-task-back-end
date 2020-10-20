<?php


namespace App\Repositories\Company;


use App\Models\Companies;
use App\Models\CompanyEmployees;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{
    public function __construct(Companies $model)
    {
        parent::__construct($model);
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
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone']
            ]);
    }

    public function index()
    {
        return $this->model->paginate(10);
    }

    /**
     * @param $data
     */
    public function insert($data)
    {
        $this->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone']
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function employees()
    {
        return $this->model->with('employees')
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function employeeByCompanyId($id)
    {
        return CompanyEmployees::where('company_id', $id)
            ->join('employees', 'company_employees.employee_id', '=', 'employees.id')
            ->select(
                'company_employees.id',
                'employees.first_name',
                'employees.last_name',
                'company_employees.created_at',
                'company_employees.updated_at'
            )->paginate(10);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function removeEmployee($id)
    {
        return CompanyEmployees::where('id', $id)
            ->delete();
    }

    public function uploadLogo($file, $id)
    {
        $this->model->where('id', $id)
            ->update([
                'logo' => $file
            ]);
    }

}
