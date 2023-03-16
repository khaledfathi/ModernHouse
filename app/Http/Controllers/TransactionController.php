<?php

namespace App\Http\Controllers;

use App\Enums\PaymentDirection;
use App\Http\Requests\Transaction\TransactionRequestWithType;
use App\Repository\Contracts\TransactionRepoContract;
use App\Repository\Contracts\TransactionTypeRepoContract;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class TransactionController extends Controller
{
    private $transactionTypeProvider; 
    private $transactionProvider; 
    public function __construct(
        TransactionTypeRepoContract $transactionTypeProvider,
        TransactionRepoContract $transactionProvider,
        )
    {
        $this->transactionTypeProvider = $transactionTypeProvider;
        $this->transactionProvider = $transactionProvider;
    }
    public function TransactionPage(){
        $todayBalance = $this->transactionProvider->GetTodayBalance() ; 
        $transactionTypes = $this->transactionTypeProvider->GetWhereNotInList(config('constants.transaction_types_execlude'));
        return view('transaction.transaction' , ['transactionTypes'=>$transactionTypes ,'todayBalance'=>$todayBalance]); 
    }
    public function NewTransaction(TransactionRequestWithType $request){
        // dd($request->documentImage); 
        if($request->documentImage){
            //save document image file 
            $file = $request->file('documentImage'); 
            $path= 'assets/upload/DocumentsImages'; 
            $imageName = time().'.'.$file->extension(); 
            $file->move(public_path($path) , $imageName);
            $request->documentImage = $path.'/'.$imageName ;  
        }

        //convert to negtaive numbe in withdraw case
        if ($request->direction == 'withdraw' || $request->transaction_type > 1 ){
            $request->amount = $request->amount * -1 ;
        }
        //make record
        $record = $this->transactionProvider->StoreTransaction($request);
        return back()->with(['ok'=>'تم حفظ معاملة مالية رقم ( '.$record.' )']); 
    }
}
