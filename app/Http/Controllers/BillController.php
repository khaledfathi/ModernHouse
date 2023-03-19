<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\BillRequest;
use App\Repository\Contracts\CustomerRepoContract;
use Illuminate\Http\Request;

class BillController extends Controller
{
    private $customerProvider ; 
    public function __construct(CustomerRepoContract $customerProvider){
        $this->customerProvider = $customerProvider; 
    }
    public function BillPage(){
        return view('bill.bill'); 
    }
    public function NewBill(BillRequest $request){
        return "new bill";
    }

    /* THIS PART FOR AJAX */ 
    public function AjaxGetCustomerByPhone (Request $request){
        $record=[];
        $isExist = false ; 
        if ($request->customerPhone ){
            $record = $this->customerProvider->GetByPhone($request->customerPhone); 
            if ($record->count()){
               $record = $record[0]; 
               $isExist = true ; 
            }else {
               $record = []; 
            }
        }
        return response()->json(['isExist'=>$isExist , 'record'=>$record]);
    }
}
