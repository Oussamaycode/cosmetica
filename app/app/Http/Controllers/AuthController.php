<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate(['name'=>['required','string','max:50'],
                            'email'=>['required','string','emial','max:255','unique:users,email'],
                            'password'=>['required','string','min:6']
                          ]);

        $user=User::create(['name'=>$request->name,
                      'email'=>$request->email,
                      'password'=>Hash::make($request->password),
        ]);

        $token = auth()->login($user);

        return response()->json(['message'=>'User succefully registred','user'=>$user,'token'=>$token],201);
    }

    public function login(Request $request){
        $data=$request->only('email','password');

        if(!auth()->attempt($data)){
            return response()->json(['error'=>'Unauthorized'],401);
        }
        else{
           $token=auth()->attempt($data);
           return response()->json(['token'=>$token]);
        }

    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Logged out']);
    }


}
