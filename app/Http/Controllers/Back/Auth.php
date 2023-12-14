<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth as Auths;
class Auth extends Controller
{
    
    public function login(){
        return view("back.auth.login");
    }

    public function loginPost(Request $request){
        if(Auths::attempt(["email"=> $request->email,"password"=> $request->password])){
            return redirect()->route("admin.dashboard");
        }
    
        return redirect()->route("admin.login")->withErrors('Email adresi veya şifre hatalı!');
    }


    public function logout(){
        Auths::logout();
        return redirect()->route('admin.login')->with('success','Başarılı Bir Şekilde Çıkış Yapıldı.');
    }
}
