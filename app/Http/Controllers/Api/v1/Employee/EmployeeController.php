<?php

namespace App\Http\Controllers\Api\v1\Employee;

use App\Exceptions\DataConflictException;
use App\Http\Controllers\Api\v1\BaseController;
use App\Http\Requests\Api\v1\Employee\PostEmployeeRequest;
use App\Models\Employees;
use App\Repositories\Employee\EmployeeRepositoryInterface;
use App\Services\RemoveEmployeeService;
use App\Utils\API\JsonPlaceHolder;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends BaseController
{
    /**
     * @var EmployeeRepositoryInterface
     */
    private $employeeInterface;

    public function __construct(EmployeeRepositoryInterface $employeeInterface)
    {
        $this->employeeInterface = $employeeInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $employee = $this->employeeInterface->index();
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->getSuccessfulResponse($employee);
    }

    /**
     * Store a newly created resource in storage.
     * @param PostEmployeeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostEmployeeRequest $request)
    {
        try {
            $this->employeeInterface->insert($request);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->insertSuccessfulResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param Employees $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Employees $employee)
    {
        return $this->getSuccessfulResponse($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $this->employeeInterface->update($request, $id);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->noContentResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param RemoveEmployeeService $employeeService
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id, RemoveEmployeeService $employeeService)
    {
        try {
            $employeeService->remove($id);
        } catch (DataConflictException $e) {
            throw $e;
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->noContentResponse();
    }

    /**
     * Populate employees table with data from jsonplaceholder api
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function populateEmployees()
    {
        DB::beginTransaction();
        try {
            $employees = (new \App\Utils\API\JsonPlaceHolder)->users();
            $data = [];
            foreach ($employees as $employee) {
                $name = explode(' ', $employee->name);

                $this->employeeInterface->insert([
                    'first_name' => $name[0] === 'Mrs.' ? $name[0] . ' ' . $name[1] : $name[0],
                    'last_name' => $name[0] === 'Mrs.' ? $name[2] : $name[1],
                ]);
            }

            DB::commit();
        } catch (GuzzleException $e) {
            throw $e;
        } catch (QueryException $e) {
            DB::rollBack();
            return $this->queryExceptionResponse($e);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e);
        }

        return $this->insertSuccessfulResponse('Users imported successfully.');
    }

    public function getEmployeesWithCompany()
    {
        try {
            $employees = $this->employeeInterface->employeeWithCompany();
        } catch (QueryException $e) {
            dd($e);
            return $this->queryExceptionResponse($e);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->getSuccessfulResponse($employees);
    }
}
