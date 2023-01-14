<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;


class UsersController extends Controller
{
    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    function login_index(Request $request)
    {
        return view('login' , ['error' => '']);
    }

    function register_index(Request $request)
    {
        return view('register' , ['error' => '']);
    }

    function login(Request $request)
    {
        $user= User::where('email' , $request['email'])->count();
        if($user==0)
            return view('login',['error' => "This email doesn't exists"]);

        if(Auth::attempt($request -> only('email','password')))
        {
            if(Auth::user() -> role==2)
                return redirect('/welcome');
            else if(Auth::user() -> role==1)
                return redirect('/add_range');
            else
                return redirect('/show_specialization');
        }
        return view('login',['error' => "Invalid Credintials"]);
    }

    function register(Request $request)
    {
        $user= User::where('email' , $request['email'])->count();
        if($user > 0)
            return view('register',['error' => "This email already exists"]);
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => 0,
            'duration' => 0,
        ]);
        return view('login',['error' => '']);
    }
}
