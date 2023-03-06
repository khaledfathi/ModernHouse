<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function TransactionPage(){
        return view('transaction.transaction'); 
    }
}
