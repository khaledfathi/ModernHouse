<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerRequest;
use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerProvider ;
    private $projectProvider;  
    public function __construct(
        CustomerRepoContract $customerProvider,
        ProjectRepoContract $projectProvider
        )
    {
        $this->customerProvider = $customerProvider; 
        $this->projectProvider = $projectProvider; 
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
        return redirect('customer/'.$record->id)->with(['ok'=>"تم حفظ العميل ( رقم $record->id )"]); 
    }
    public function CustomerProfile (Request $request){
        $projects = null ;
        $customer = null;  
        $customerRecord = $this->customerProvider->GetById($request->id);
        if($customerRecord->count()){
            $customer = $customerRecord[0]; 
            session(['customer'=>$customer]); 
            $projects = $this->projectProvider->GetByCustomerId($request->id);
        }
        return view('customer.customerProfile' , ['record'=>$customer , 'projects'=>$projects]); 
    }
    public function DeleteCustomer(Request $request)
    {
        $isDeleted = $this->customerProvider->Destroy($request->id);
        if ($isDeleted){
            return back()->with(['ok'=>'تم حذف العميل']);
        }
    }
    
}
