<?php

namespace App\Exceptions;

use App\Http\Response\Api\v1\ResponseTemplate;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTemplate;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof ValidationException ) {
                return $this->customErrorResponse(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'Invalid Data Entries',
                    $e->errors()
                );
            }else if($e instanceof NotFoundHttpException) {
                return $this->customErrorResponse(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'Entry not found'
                );
            }else if ($e instanceof AuthenticationException
                || $e instanceof AuthorizationException
                || $e instanceof UnauthorizedHttpException) {

                return $this->customErrorResponse(
                    Response::HTTP_UNAUTHORIZED,
                    $e->getMessage(),
                );
            }else if($e instanceof DataConflictException){
                return $this->customErrorResponse(
                    Response::HTTP_CONFLICT,
                    $e->getMessage(),
                );
            }

        });
    }
}
