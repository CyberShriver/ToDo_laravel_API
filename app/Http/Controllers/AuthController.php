<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(){
        return 'this login page';
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
            'Token'=>$user->createToken('Token of '.$user->name)->plainTextToken
        ]);
    }

    public function logout(){
        return response()->json('logout successful');
    }
}
