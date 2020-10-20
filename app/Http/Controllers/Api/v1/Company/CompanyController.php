<?php

namespace App\Http\Controllers\Api\v1\Company;

use App\Exceptions\DataConflictException;
use App\Http\Controllers\Api\v1\BaseController;
use App\Http\Requests\Api\v1\Company\PostCompanyRequest;
use App\Models\Companies;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Services\PostCompanyEmployees;
use App\Upload\UploadImage;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyInterFace;

    public function __construct(CompanyRepositoryInterface $companyInterface)
    {
        $this->companyInterFace = $companyInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $company = $this->companyInterFace->index();
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->getSuccessfulResponse($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostCompanyRequest $request)
    {
        try {
            $this->companyInterFace->insert($request);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->insertSuccessfulResponse();
    }

    /**
     * Display the specified resource.
     *
     * @param Companies $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Companies $company)
    {
        return $this->getSuccessfulResponse($company);
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
            $this->companyInterFace->update($request, $id);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->noContentResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->companyInterFace->remove($id);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->noContentResponse();
    }

    /**
     * @param Request $request
     * @param $id
     * @param PostCompanyEmployees $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function addNewEmployee(Request $request, $id, PostCompanyEmployees $company)
    {
        try {
            $company->newEmployee($id, $request->employee_id);
        } catch (DataConflictException $e) {
            throw $e;
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->noContentResponse();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployees()
    {
        try {
            $employees = $this->companyInterFace->employees();
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->getSuccessfulResponse($employees);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEmployeesByCompanyId($id)
    {
        try {
            $employees = $this->companyInterFace->employeeByCompanyId($id);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->getSuccessfulResponse($employees);
    }

    public function removeEmployee($id)
    {
        try {
            $this->companyInterFace->removeEmployee($id);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->noContentResponse();
    }

    public function uploadLogo(Request $request, $id)
    {
        $image = new UploadImage($request);

        try {
            $image->setUploadDir('/logos');
            $image->upload();

            $this->companyInterFace->uploadLogo(
                $image->getFilePath(),
                $id
            );
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }

        return $this->noContentResponse();
    }

}
