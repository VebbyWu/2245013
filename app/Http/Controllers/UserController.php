<?php

namespace App\Http\Controllers;

use app\http\requests\UserRegisterRequest;
use app\http\requests\userloginrequest;

use app\http\resources\UserResource;
use app\Models\User;

use Illuminate\Http\Request;
use illuminate\http\JsonResponse;

use illuminate\support\str;
use illuminate\support\facades\hash;

use illuminate\http\exceptions\httpresponseexception;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function login(UserloginRequest $request): userresource
    {
        $data = $request->validated();
        $user = User::where('email', $data['email'])->first();
        if (!$user ||!hash::check($data['password'], $user->password)){
            throw new httpresponseexception (response([
                'errors' => [
                    'message' => ['username or password wrong'],
                ]
                ], 401));
        }
        
        $user->remember_token = str::uuid()->tostring();
        $user->save();
        return new UserResource($user);
    }
}



