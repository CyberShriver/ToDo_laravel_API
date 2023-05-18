<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginRequest $request){

        $request->validated($request->all());

        $user=User::where('email',$request->email)->first();

        if(!Auth::attempt($request->only(['email','password']))){

            return $this->error('','crediantial not match',401);
            
        }

        return $this->success([
            'user'=>$user,
            'Token'=>$user->createToken('Token of '.$user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request){

        $request->Validated($request->all());

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return $this->success([
            'user'=>$user,
            'Token'=>$user->createToken('Token of ' .$user->name)->plainTextToken
        ]);
    }

    public function logout(){
        
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message'=>'Your token have been deleted successful'
        ]);
    }
}
