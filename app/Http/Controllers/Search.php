<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Search extends Controller
{
    public function SearchPage(){
        return view('search'); 
    }
}
