<?php


namespace App\Http\Response\Api\v1;

use Illuminate\Http\Response;

/**
 * Trait Response
 * @package App\Traits\Http\Json\Requests\Api\V1
 */
trait ResponseTemplate
{
    /**
     * @param int $status
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(
        $status = 200,
        $message = '',
        array $data = []
    ): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * @param $status
     * @param string $message
     * @param array $errors
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function customErrorResponse(
        $status,
        $message = '',
        array $errors = [],
        array $data = []
    ): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'success' => false, 'message' => $message,
            'errors' => $errors,
            'data' => $data
        ], $status);
    }

    /**
     * @param $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function queryExceptionResponse($e)
    {
        return response()->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'success' => false,
            'message' => 'A database query error has occurred.',
            'errors' => $e->errors(),
            'data' => []
        ], $e);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function insertSuccessfulResponse(
        $message = 'Entry Successfully Added.'
    ){
        return response()->json([
            'status' => Response::HTTP_CREATED,
            'success' => true,
            'message' => $message,
            'errors' => [],
            'data' => []
        ]);
    }

    /**
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContentResponse($status = 204): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'status' => $status,
                'success' => true
            ], $status);
    }

    /**
     * @param $exemption
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($exemption, $code = 400, $data = []): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'message' => $exemption->getMessage(),
                'data' => $data,
                'success' => true
            ], $code
        );
    }

    public function getSuccessfulResponse($data) {
        return response()->json(
            [
                'message' => 'Successful',
                'data' => $data,
                'success' => true
            ], Response::HTTP_OK
        );
    }

}
