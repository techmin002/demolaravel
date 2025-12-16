<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = new User();
        $user['name'] = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
        // dd($user);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'User Register Successfully'
        ]);
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid login details'], 401);
        }
        $user = User::where('email', $request['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'User Login Successfully'

        ]);
    }
    public function logout()
    {
       $user = Auth::guard('sanctum')->user();
       if($user)
       {
        $user->currentAccessToken()->delete();
        return response()->json([
            'token_type' => 'Bearer',
            'message' => 'User logout  Successfully'

        ]);
       }else{
        return response()->json([
            'token_type' => 'Bearer',
            'message' => 'User not Found'

        ]);
       }
    }
}
