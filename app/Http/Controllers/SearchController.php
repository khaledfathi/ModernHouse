<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use App\Repository\Contracts\CustomerRepoContract;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class SearchController extends Controller
{
    private $customerProvider ; 
    public function __construct(CustomerRepoContract $customerProvider){
        $this->customerProvider = $customerProvider; 
    }
    public function SearchPage(){
        return view('search.search'); 
    }
    public function Find(Request $request){
        if ($request->find != null){
            switch ($request->searchFor){
                case 'customer':
                    $data['searchFor']= 'customer'; 
                    switch($request->searchBy){
                        case 'id':
                            $records = $this->customerProvider->GetById($request->find);
                            $data['records'] =$records;
                            break;
                        case 'name':
                            $records = $this->customerProvider->GetByName($request->find);
                            $data['records'] =$records;
                            break;
                        case 'phone':
                            $records = $this->customerProvider->GetByPhone($request->find);
                            $data['records'] =$records;
                            break;
                    }
                    break; 
                case 'project':
                    $data['searchFor']= 'project'; 
                    break; 
                case 'bill':
                    $data['searchFor']= 'bill'; 
                    break; 
                case 'transaction':
                    $data['searchFor']= 'transaction'; 
                    break; 
                case 'product':
                    $data['searchFor']= 'product'; 
                    break; 
            }
            if($data['records']->count()){
                return back()->with($data); 
            }
            return back()->with(['noResult' =>'لم يتم العثور على نتائج']); 
        }
        return back(); 

    }
}
