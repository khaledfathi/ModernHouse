<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\BillRequest;
use App\Http\Requests\Customer\CustomerRequest;
use App\Repository\Contracts\BillDetailsRepoContract;
use App\Repository\Contracts\BillRepoContract;
use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use Illuminate\Http\Request;

class BillController extends Controller
{
    private $customerProvider ;
    private $productProvider; 
    private $billProvider; 
    private $billDetailsProvider; 
    public function __construct(
        CustomerRepoContract $customerProvider,
        ProductRepoContract $productProvider,
        BillRepoContract $billProvider,
        BillDetailsRepoContract $billDetailsProvider
        )
    {
        $this->customerProvider = $customerProvider; 
        $this->productProvider = $productProvider; 
        $this->billProvider = $billProvider;
        $this->billDetailsProvider = $billDetailsProvider;  
    }
    public function BillPage(){
        return view('bill.bill'); 
    }
    public function NewBill(BillRequest $request){
        //action on customer section 
        $actionFlag= null; 
        $customerRecord = null ; 
        if ($request->existCustomerCheck){
            $customerRecord = $this->customerProvider->GetByPhone($request->customerPhone)[0];
            $actionFlag = 'oldCustomer'; 
        }else if ($request->newCustomerCheck){
            //check if customer is already register 
            if ($this->customerProvider->GetByPhone($request->customerPhone)->count()) return back()->withErrors('رقم تليفون العميل مسجل بالفعل');
            //careate new customer
            $customerRecord = $this->customerProvider->StoreFromBill([
                'name'=> $request->customerName, 
                'phone'=>$request->customerPhone
            ]);
            $request->session()->flash('ok','تم حفظ عميل جديد رقم ( '.$customerRecord->id.' )'); 
            $actionFlag='newCustomer'; 
        }else {
            $actionFlag= 'unknownCustomer'; 
        }

        //creat bill (function)
        $createBill = function ($request , $customerId=null){
            $data =[
                'date' =>$request->date,
                'time' => $request->time,
                'customer_name'=>$request->customerName,
                'customer_phone'=>$request->customerPhone, 
                'user_id'=> auth()->user()->id, 
            ];
            if($customerId) $data['customer_id']= $customerId; 
            return  $this->billProvider->Store($data);
        };

        //bind products to bill (function)
        $bindProductsToBill = function ($products , $bill)
        {
            $productsFlag = false ; 
            foreach($products as $product){
                if($product->productId){
                    //check if procuct id is  exist
                    $productObject = $this->productProvider->GetById($product->productId);
                    if ( ! $productObject->count()) return false;
                    $productObject = $productObject[0]; //get first
                    // check if product quantity 
                    if ( $product->quantity > $productObject->quantity || $productObject->quantity == 0 ) return false;
                    
                    //pull product from products table (stock)
                    $this->productProvider->UpdateQuantity($productObject->quantity - $product->quantity , $product->productId); 

                    //store product details
                    $productsFlag = true ; 
                    $this->billDetailsProvider->Store([
                        'product_name' => $product->productName,
                        'price' => $product->price, 
                        'quantity' => $product->quantity,
                        'total' => $product->total, 
                        'bill_id'=>$bill->id,
                        'product_id'=>$product->productId,
                        'user_id'=>auth()->user()->id, 
                    ]);
                }
            } 
            return $productsFlag; 
        };

        //action on products  sections
        $products = json_decode($request->collectedProducts);
        switch ($actionFlag){
            case 'oldCustomer':
            case 'newCustomer':
                //save bill with customer id
                if(!empty($products)){
                    //creatt bill 
                    $bill = $createBill($request , $customerRecord->id); 
                    //bind products to this bill
                    if (!$bindProductsToBill($products , $bill)){
                        return back()->withErrors('خطأ - المنتج  غير مسجل او الكمية غير متاحة'); 
                    }; 
                }else{
                    return back()->withErrors('لا توجد منتجات بالفاتورة'); 
                }
                break ; 
            case 'unknownCustomer':
                //save bill with out  customer id
                if(!empty($products)){
                     //creatt bill 
                    $bill = $createBill($request ); 
                    //bind products to this bill 
                    if (!$bindProductsToBill($products , $bill)){
                        return back()->withErrors('خطأ - المنتج  غير مسجل او الكمية غير متاحة'); 
                    }; 
                }else {
                    return back()->withErrors('لا توجد منتجات بالفاتورة'); 
                }
                break; 
        }
        
        $fullBill = $this->billProvider->GetFullBillById($bill->id);
        $totalInvoice = $this->billProvider->GetTotalInvoiceById($bill->id); 
        
        session(['fullBill'=>$fullBill , 'totalInvoice'=>$totalInvoice]); 
        return redirect('bill/preview');
    }
    public function BillPreviewPage()
    {
        return view('bill.billPreview', ['fullBill'=>session('fullBill') , 'totalInvoice'=>session('totalInvoice')]); 
    }

    /*#################################*/ 
    /* THESE NEXT MTHODS ARE FOR AJAX */ 
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
    public function AjaxGetProductById(Request $request){
        $record = [];
        $isExist = false ; 
        if ($request->productId){
            $record = $this->productProvider->GetById($request->productId); 
            if ($record->count()){
                $record= $record[0];
                $isExist = true ; 
            }else {
                $record= []; 
            }
        }
        return response()->json(['isExist'=>$isExist , 'record'=>$record]);
    }
}
