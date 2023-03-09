<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class SearchController extends Controller
{
    private $customerProvider ; 
    private $projectProvider; 
    public function __construct(
            CustomerRepoContract $customerProvider ,
            ProjectRepoContract $projectProvider ,
        )
    {
        $this->customerProvider = $customerProvider; 
        $this->projectProvider = $projectProvider; 
    }
    public function SearchPage(){
        return view('search.search'); 
    }
    public function Find(Request $request){
        if ($request->find != null){
            switch ($request->searchFor){
                case 'customer':
                    $data['searchFor']= 'customer'; 
                    switch($request->customerSearchBy){
                        case 'customer_id':
                            $records = $this->customerProvider->GetById($request->find);
                            $data['records'] =$records;
                            break;
                        case 'customer_name':
                            $records = $this->customerProvider->GetByName($request->find);
                            $data['records'] =$records;
                            break;
                        case 'customer_phone':
                            $records = $this->customerProvider->GetByPhone($request->find);
                            $data['records'] =$records;
                            break;
                    }
                    break; 
                case 'project':
                    $data['searchFor']= 'project'; 
                    switch($request->projectSearchBy){
                        case 'project_id':
                            $records = $this->projectProvider->GetById($request->find); 
                            $data['records'] =$records;
                            break;
                        case 'project_customer_name':
                            $records = $this->projectProvider->GetByCustomerName($request->find);
                            $data['records'] =$records;
                            break;
                        case 'project_customer_phone':
                            $records = $this->projectProvider->GetByCustomerPhone($request->find);
                            $data['records'] =$records;
                            break;
                    }
                    break; 
                case 'bill':
                    // $data['searchFor']= 'bill'; 
                    return back(); 
                    break; 
                case 'transaction':
                    // $data['searchFor']= 'transaction'; 
                    return back(); 
                    break; 
                case 'product':
                    // $data['searchFor']= 'product'; 
                    return back(); 
                    break;
                default : 
            }

            if($data['records']->count()){
                return back()->with($data); 
            }
            return back()->with(['noResult' =>'لم يتم العثور على نتائج']); 
        }
        return back(); 

    }
}
