<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function ProfilePage(){
        return view('profile.profile'); 
    }
}
