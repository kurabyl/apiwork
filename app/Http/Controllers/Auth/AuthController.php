<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User\UseCases;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['signin', 'refresh']]);
    }

    public function signUp(Request $request,UseCases\SignUp\Request\Handler $handler)
    {
        $user = $handler->handle($request);
        return $this->respondWithToken($user);
    }

    public function signIn(Request $request,UseCases\Auth\Request\Handler $handler)
    {
        $user = $handler->handle($request);

        if ($user) {
            return $this->respondWithToken($user);
        }
        return response()->json(['error' => 'Unauthorized', Response::HTTP_UNAUTHORIZED]);


    }

    public function info()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

}
