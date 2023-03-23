<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\BillRepoContract;
use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use Carbon\Traits\ToStringFormat;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $customerProvider ; 
    private $projectProvider; 
    private $productProvider;
    private $billProvider; 
    public function __construct(
            CustomerRepoContract $customerProvider ,
            ProjectRepoContract $projectProvider ,
            ProductRepoContract $productProvider,
            BillRepoContract $billProvider
        )
    {
        $this->customerProvider = $customerProvider; 
        $this->projectProvider = $projectProvider; 
        $this->productProvider = $productProvider;
        $this->billProvider = $billProvider;  
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
                    $data['searchFor']= 'bill';
                    switch($request->billSearchBy){
                        case 'bill_id':
                            $records = $this->billProvider->GetById($request->find); 
                            
                            if($records->count()){
                                $fullBillDetails = $this->billProvider->GetFullBillById($request->find);
                                //get full information about invoice 
                                $records[0]->totalInvoice = $fullBillDetails->sum('total');
                                $records[0]->productsCount = $fullBillDetails->count(); 
                                $records[0]->itemsCount = $fullBillDetails->sum('quantity'); 
                            }
                            $data['records'] =$records;
                            break;
                        case 'bill_customer_phone':
                            $bills = $this->billProvider->GetByCustomerPhone($request->find); 
                            foreach($bills as $bill){
                                $billDetails = $this->billProvider->GetFullBillById($bill->id); 
                                $bill->totalInvoice = $billDetails->sum('total');
                                $bill->productsCount = $billDetails->count(); 
                                $bill->itemsCount = $billDetails->sum('quantity');
                            }
                            $data['records'] =$bills;
                            break;
                        case 'bill_customer_name':
                            $bills = $this->billProvider->GetByCustomerName($request->find); 
                            foreach($bills as $bill){
                                $billDetails = $this->billProvider->GetFullBillById($bill->id); 
                                $bill->totalInvoice = $billDetails->sum('total');
                                $bill->productsCount = $billDetails->count(); 
                                $bill->itemsCount = $billDetails->sum('quantity');
                            }
                            $data['records'] =$bills;
                            break;
                    }
                    break; 
                case 'transaction':
                    // $data['searchFor']= 'transaction'; 
                    return back(); 
                    break; 
                case 'product':
                    $data['searchFor']= 'product';
                    switch($request->productSearchBy){
                        case 'product_id':
                            $records = $this->productProvider->GetById($request->find); 
                            $data['records'] =$records;
                            break; 
                        case 'product_name':
                            $records = $this->productProvider->GetByName($request->find); 
                            $data['records'] =$records;
                            break;
                        } 
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
