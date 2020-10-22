<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Api\v1\BaseController;
use App\Http\Requests\Api\v1\Auth\PostLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{

    public function login(PostLoginRequest $request): \Illuminate\Http\JsonResponse
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $success['token'] = $user->createToken('YCW CRUD')->accessToken;
            $success['user'] = $user;

            return $this->successResponse(
                Response::HTTP_OK,
                'Successfull',
                $success
            );
        }

        return $this->errorResponse(
            Response::HTTP_UNAUTHORIZED,
            'unauthorized',
            'Invalid Username or Password'
        );
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
