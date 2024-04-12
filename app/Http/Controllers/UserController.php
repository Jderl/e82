<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //get user
    public function User()
    {
        $user = Auth()->user();

        // Check if user is authenticated
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }
    }
}
