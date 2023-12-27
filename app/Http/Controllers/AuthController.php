<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request){
        // dd(Hash::make(123456));

        if(!empty(Auth::check())&& Auth::user()->is_admin== 1){

            return view('admin/dashboard/dashboard');
        }
        return view('admin.auth.login');

    }

    public function auth_login_admin(Request $request){
        // dd($request->all());
        $remember = !empty($request->remember)?true:false;
        if(Auth::attempt(['email'=> $request->email, 'password'=> $request->password, 'is_admin'=>1, 'status'=>0], $remember)){
            return redirect('admin/products');
        }
        else{
            return redirect()->back()->with('error','Please enter correct email & password');
        }
    }
    public function logout_admin(Request $request){
        Auth::logout();
        return redirect('admin');
    }
}
