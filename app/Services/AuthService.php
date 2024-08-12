<?php

namespace App\Services;

use App\Traits\ResponseApi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    use ResponseApi;

    /**
     * @param  string  $email  User email data
     * @param  string  $password  User password data
     * @return JsonResponse $response Response login data
     */
    public function login(string $email, string $password): JsonResponse
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;

            return $this->successResponse($token, 'Login was made successfully.', 200);

        } else {
            return $this->errorResponse('User for this information could not be found.The wrong password or email.', 400);
        }
    }

    /**
     * @param  Request  $request  Logout data
     * @return JsonResponse $response Response logout data
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return $this->successResponse('Logout successful.', 200);

    }
}
