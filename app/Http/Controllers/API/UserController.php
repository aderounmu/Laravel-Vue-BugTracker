<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Validator;

class UserController extends Controller
{
    //

    public function login(Request $request){
        $login = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);

        if(Auth::attempt($login)){
        //if(Auth::attempt(['email' => $request->email , 'password'=> $request->password])){
            $success['token'] = Auth::user()->createToken('my Token')->accessToken;
            $success['id'] = Auth::user()->id;
            $success['name'] = Auth::user()->name;
            $success['message'] = 'Login Successful';
            return response()->json($success);
        }else{
            return response(['message' => 'Invalid login credentials'],403);
        }
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]
        );
        if($validator->fails()){
            return response([
                'message' => 'Validation Error ',
                'Error' => $validator->errors(),
            ],403);
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('myToken')->accessToken;
            $success['id'] = $user->id;
            $success['name'] = $user->name;
            $success['message'] = 'Registration Successful';
            return response()->json($success);
        }
    }

    public function index(){
        return User::all();
    }

    public function test(){
        return 'API is connected and working';
    }
}
