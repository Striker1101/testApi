<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    //
    public function createUser(Request $request)
    {
        try{
            $validateUser =validator::make($request->all(),
            [
                'name' => 'required',
                'email' => 'required | email | unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status'=> false,
                    'message' => "validation error",
                    "errors" => $validateUser -> errors()
                ], 401);
            }

            //created user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status'=> true,
                'message'=> 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        }catch(\Throwable $th){
            return response()->json([
                'status' =>false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function loginUser(Request $request){
        try{

            $validateUser =validator::make($request->all(),
            [
                'email' => 'required | email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status'=> false,
                    'message' => "validation error",
                    "errors" => $validateUser -> errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status' => false,
                    "message" => "Email & Password does not match"
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status'=> true,
                'message'=> 'User Login Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        }catch(\Thowable $th){
            return response()->json([
                'status' =>false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

}
