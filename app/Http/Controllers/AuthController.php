<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use \stdClass;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'token' => $request->user()->createToken('token-aveonline')->plainTextToken,
                'message' => 'Login correcto'
            ], 200);
        }

        return response()->json([
            'message' => 'Login incorrecto'
        ], 401);
    }
}
