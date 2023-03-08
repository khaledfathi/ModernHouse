<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerRequest;
use App\Repository\Contracts\CustomerRepoContract;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerProvider ; 
    public function __construct(CustomerRepoContract $customerProvider){
        $this->customerProvider = $customerProvider; 
    }
    public function CustomerPage(){
        return view('customer.customer'); 
    }
    public function NewCustomer(CustomerRequest $request){
        $record = $this->customerProvider->Store($request);
        if ($request->direction == 'saveAndAddProject'){
            session(['customer'=>$record]);
            return redirect('project');
        }
        return back()->with(['ok'=>'تم الحفظ بنجاح' , 'id'=>$record->id]); 
    }
    
}
