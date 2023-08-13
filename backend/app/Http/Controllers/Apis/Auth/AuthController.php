<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Classes\MakeResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function login(LoginUserRequest $request)
    {
        try{
            $user = User::where('email', $request->email)->first();
            if(!$user){
                return MakeResponse::errorResponse("User does not exist", 422);
            }

            if (Hash::check($request->password, $user->password)) {  //check user password and create new token
                $token = $user->createToken('RaihanFarhad')->accessToken;
                $data = [
                    'user' => $user,
                    'token' => $token
                ];
                return MakeResponse::successResponse("user created successfully", 200, $data);
            } else {
                return MakeResponse::errorResponse("Password mismatch", 422);
            }
        
        }catch(\Exception $exception){
            Log::error("login error : " . json_encode($exception->getMessage()) . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }

    public function logout(Request $request)
    {
        try{
            $token = $request->user()->token();
            $token->revoke(); //destroy user token for logout
            return MakeResponse::successResponse("You have been successfully logged out!", 200);

        }catch(\Exception $exception){
            Log::error("logout error : " . json_encode($exception->getMessage()) . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }

    public function searchByEmail(Request $request)
    {
        try{
            $searchEmail = $request->input('email');
            $users = User::where('email', 'LIKE', '%' . $searchEmail . '%')->get();

            if ($users->isEmpty()) {
                MakeResponse::errorResponse('No users found for the provided email', 404);
            }

            return MakeResponse::successResponse("Users matching the email were found", 200, $users);

        }catch(\Exception $exception){
            Log::error("user search by email : " . json_encode($exception->getMessage()) . " trace : " . json_encode($exception->getTrace()));
            return MakeResponse::errorResponse();
        }
    }
}
