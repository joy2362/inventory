<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin',['except' => ['login','registation']]);
    }
    //,['except' => ['login','registation']]
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('admin')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
            'name' => auth('admin')->user()->name,
        ]);
    }

    public function me()
    {
        return response()->json(auth('jwt')->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('admin')->refresh());
    }

    public function registation(Request $request){
        $validatedData = $request->validate([
            'name'=>'required|max:15|min:3',
            'email'=>'required|unique:users',
            'password'=>'required|min:5|:max:12|confirmed'
        ]);
        $user=new Admin;
        $user->name = $request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return $this->login($request);
    }
}
