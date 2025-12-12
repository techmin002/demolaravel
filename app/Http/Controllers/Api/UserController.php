<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::select('id','name', 'email')->latest()->get();
        if ($users) {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => $users,
                'message' => "Users Found",
            ]);
        } else {
            return response()->json([
                'status' => 'erros',
                'code' => 404,
                'message' => "Users Not Found",
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $existuser = User::where('email',$request['email'])->first();
        if($existuser){
            return response()->json([
                'status' => 'erros',
                'code' => 404,
                'message' => "User already exist with this $request->email email address",
            ]);
        }
        $user = new User();
        $user['name'] = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
        if($user)
        {
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => $user,
                'message' => "User Store Successfully",
            ]);
        }else{
            return response()->json([
                'status' => 'erros',
                'code' => 404,
                'message' => "Users Not Created. Something went wrong",
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = $request['password'];
            $user->save();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'data' => $user,
                'message' => "User Updated Successfully",
            ]);
        }else{
            return response()->json([
                'status' => 'erros',
                'code' => 404,
                'message' => "User id Not not found",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $user = User::find($id);
         if($user){
            $user->delete();
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => "User deleted Successfully",
            ]);
         }else{
            return response()->json([
                'status' => 'erros',
                'code' => 404,
                'message' => "User id Not not found",
            ]);
         }
    }
}


