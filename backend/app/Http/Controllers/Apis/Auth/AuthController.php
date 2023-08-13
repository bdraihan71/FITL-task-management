<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Classes\MakeResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        try{
            $request['password']=Hash::make($request['password']);  //create new user
            $user = User::create($request->toArray());  //create token
            $token = $user->createToken('RaihanFarhad')->accessToken;
            $data = [
                        'user' => $user,
                        'token' => $token
                    ];
                return MakeResponse::successResponse("user created successfully", 200, $data);
        
        }catch(\Exception $exception){
            Log::error("registration error : " . json_encode($exception->getMessage()) . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }

    public function login()
    {
        
    }

    public function logout()
    {
        
    }
}
