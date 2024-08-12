<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @param  UserLoginRequest  $request  Login data
     * @return JsonResponse $response Response login data
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $service = new AuthService;

        return $service->login($request->input('email'), $request->input('password'));
    }

    /**
     * @param  Request  $request  Logout data
     * @return JsonResponse $response Response logout data
     */
    public function logout(Request $request): JsonResponse
    {
        $service = new AuthService;

        return $service->logout($request);
    }
}
