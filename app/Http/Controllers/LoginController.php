<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function LoginPage()
    {
        return view('login.login');
    }
    public function Login(Request $request){
        if ( Auth::attempt(['name' => $request->name, 'password' => $request->password ]) ) {
            if (auth()->user()->status=='disabled'){
                auth()->logout(); 
                return redirect()->back()->withErrors('الحساب مغلق من الادارة') ; 
            }
            return redirect('search'); 
        }
        return redirect()->back()->withErrors('خطأ بالاسم او كلمة المرور') ; 
    }
    public function Logout(){
        Auth::logout(); 
        return redirect('login');
    }
}