<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);// if you are signed you should not able to register it takes away register
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd('abc');//die dump will kill the page and output anything you put inside
        //TODO validation
//        dd($request->email);
        $this->validate($request,[
            'name'=> 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed',
        ]);

        //TODO store user
        User::create(array(
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ));

        //TODO sign the user in
        auth()->attempt($request->only('email', 'password'));//request only returns array with the fields only the fields inside

         //TODO redirect
         return   redirect()->route('dashboard');


    }
}
