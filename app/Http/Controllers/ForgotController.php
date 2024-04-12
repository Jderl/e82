<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgetRequest;
use App\Mail\ForgetMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    //Forget pass
    public function ForgetPassoword(ForgetRequest $request)
    {
        //get the email address 
        $email = $request->email;
        //check if the email addrees is exist ?
        //querybuilder 
        if (DB::table("users")->where("email", $email)->doesntExist()) {
            return response([
                'message' => 'Invalid Email'
            ], 401);
        }
        //if email exist 
        //generate a pin code 
        $token = rand(10, 100000);
        try {
            //insert passwords_resets table
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token
            ]);
            // send mail using forgetMail
            Mail::to($email)->send(new ForgetMail($token));
            return response([
                'message' => 'Reset password mail sent to email'
            ]);
        } catch (Exception $exception) {
            //system error 
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    
}
