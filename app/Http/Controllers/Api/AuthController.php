<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        //valid
        // dd($request);
        $errors = Validator::make($request->all(),[
            "name" => 'required|string|max:100',
            "email" => 'required|email|max:255',
            "password" => 'required|string|min:6|confirmed',

        ]);

        if($errors->fails()){
            return response()->json([
                'error' => $errors->errors() // errors   -> class validator
            ],301);
        }

        //hash password

        $hash_password = bcrypt($request->password);

        //create token
        $access_token = Str::random(64);

        // create user
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hash_password,
            "access_token" => $access_token,

        ]);

        // redirect
        return response()->json([
            'msg' => "User register Successfuly",
            "access_token" => $access_token,
        ],200);
    }


    public function login(Request $request){
        //valid
        // dd($request);
        $errors = Validator::make($request->all(),[
            "email" => 'required|email|max:255',
            "password" => 'required|string|min:6',

        ]);

        if($errors->fails()){
            return response()->json([
                'error' => $errors->errors() // errors   -> class validator
            ],301);
        }

        // check email
        $user = User::where('email',$request->email)->first();
        if($user){

             //hash password

            $valid =Hash::check($request->password, $user->password);
            if($valid){
            //update token
            $access_token = Str::random(64);
                $user->update([
                    "access_token" => $access_token ,
                ]);
            }else{
                return response()->json([
                'msg' => "error cradinonal email or password",
            ],301);
            }

        }else{
            return response()->json([
            'msg' => "error cradinonal email or password",
        ],301);
        }



        // login , message
        return response()->json([
            'msg' => "User login Successfuly",
            "access_token" => $access_token,
        ],200);
    }


    public function logout(Request $request){
        // login -> have access_token -> header
        $access_token = $request->header('access_token');
        //
        if($access_token !== null ){
            $user = User::where('access_token',$access_token)->first();
            if($user){
                // empty access token
                $user->update([
                    "access_token" => '',
                ]);
            }else{
                return response()->json([
                'msg' => "user not found",

                ],404);
            }
        }else{
                return response()->json([
                'msg' => "access token not correct or not send",

                ],301);
        }

                // logout , message
        return response()->json([
            'msg' => "User logout Successfuly",
        ],200);
    }
}
