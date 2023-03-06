<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function SettingPage(){
        return view('setting.setting'); 
    }
}
