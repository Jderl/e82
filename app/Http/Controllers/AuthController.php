<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Login 
    public function Login(Request $request)
    {
        try {
            if (Auth::attempt($request->only("email", "password"))) {
                $user = Auth::user();
                $token = $user->createToken("app")->accessToken;

                return response([
                    'message' => "Successfully Login",
                    'token' => $token,
                    'user' => $user
                ], 200);
            }
        } catch (Exception $exception) {
            //system error 
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }
        //expected error
        return response([
            'message' => 'Invalid Email or Password',
        ], 401);
    }

    //register with request validation [Controller/Request/RegisterRequest]
    public function Register(RegisterRequest $request)
    {
        try {
            //elquent 
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),

            ]);
            //token
            $token = $user->createToken('app')->accessToken;
            //response
            return response([
                'message' => "Registration Successfull",
                'token' => $token,
                'user' => $user
            ], 200);
        } catch (Exception $exception) {
            //system error 
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }
        return response();
    }
}
