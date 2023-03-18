<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Requests\Transaction\TransactionRequestWithType;
use App\Repository\Contracts\TransactionRepoContract;
use App\Repository\Contracts\TransactionTypeRepoContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        /*
        convert to negtaive numbe in withdraw case,
        and make all transaction mark as withdraw except unclassified case
        */
        if ($request->direction == 'withdraw' || $request->transaction_type > 1 ){
            $request->amount = $request->amount * -1 ;
            $request->direction ='withdraw'; 
        }
        //make record
        $record = $this->transactionProvider->StoreTransaction($request);
        return back()->with(['ok'=>'تم حفظ معاملة مالية رقم ( '.$record->id.' )']); 
    }
    public function TransactionQueryPage(){
        $transactionTypes = $this->transactionTypeProvider->GetAllLimited(); 
        return view('transaction.transactionQuery', ['transactionTypes'=>$transactionTypes]);
    }
    public function QueryFind(Request $request)
    {
        $data = null; 
        switch ($request->queryFor){
            case 'byId':  
                $data['queryFor'] = 'byId';
                ($request->findById) ? $request->findById : $request->findById='' ;
                $data['records'] = $this->transactionProvider->GetByIdLimited($request->findById);
                break;
            case 'byDate': 
                $data['queryFor'] = 'byDate'; 
                //false for if 'all' seleceted
                $request->transactionType = ($request->transactionType == 'all') ? false : $request->transactionType ; 
                //prevent Date error from database
                $request->findByDate = ($request->findByDate) ? $request->findByDate : '0000-00-00'; 
                $request->findByToDate = ($request->findByToDate) ? $request->findByToDate : '0000-00-00'; 
                
                //if quey in period (from date and to  date)
                if($request->has('period')){
                    $request->validate(['findByDate'=>'nullable|date'],['findByDate.date'=>'صيغة التاريخ غير صالحة']);
                    $request->validate(['findByToDate'=>'nullable|date'],['findByToDate.date'=>'صيغة التاريخ غير صالحة']);
                     //is transaction type = spcific id ?
                    if ($request->transactionType){
                        $data['records']  = $this->transactionProvider->GetByPeriodAndTypeLimted($request->findByDate , $request->findByToDate , $request->transactionType);
                    }else{                        
                        $data['records']  = $this->transactionProvider->GetByPeriodLimted($request->findByDate , $request->findByToDate);
                    }
                }else {
                    $request->validate(['findByDate'=>'nullable|date'],['findByDate.date'=>'صيغة التاريخ غير صالحة']);
                    //is transaction type = spcific id ?
                    if ($request->transactionType){
                        $data['records'] = $this->transactionProvider->GetByDateAndTypeLimted($request->findByDate , $request->transactionType);  
                    }else{                        
                        $data['records'] = $this->transactionProvider->GetByDateLimted($request->findByDate); 
                    }
                }
                break;
            default : 
                return back();  
        }
        if (isset($data['records'])){
            if ($data['records']->count()){
                return back()->with(['data'=>$data]); 
            }
        }
        return back()->with(['noResults'=>'لم يتم العثور على نتائج']);
    }
    public function TransactionProfile(Request $request){
        $record = $this->transactionProvider->GetByIdLimited($request->id); 
        $transactionTypes = $this->transactionTypeProvider->GetAllLimited(); 
        ($record->count()) ? $record = $record[0] : $record = null; 
        return view('transaction.transactionProfile' , ['record'=>$record , 'transactionTypes'=>$transactionTypes]); 
    }
    public function DestroyTransaction (Request $request){

        $record =  $this->transactionProvider->GetByIdLimited($request->id); 
        if ($record->count()){
            //perpare 'document image's path to delete
            $imagePath = $record[0]->document_image; 
            ($imagePath)? File::delete(public_path($imagePath)) : null ;  
            $this->transactionProvider->Destroy($request->id); 
            return redirect('transactionquery')->with(['ok'=>'تم حذف معاملة مالية رقم ( '.$request->id.' )']);  
        };
        return redirect('transactionquery');  
    }
    public function UpdateTransaction(TransactionRequestWithType $request){
        /*
        convert to negtaive numbe in withdraw case,
        and make all transaction mark as withdraw except unclassified case
        */
        if ($request->direction == 'withdraw' || $request->transaction_type > 1 ){
            $request->amount = $request->amount * -1 ;
            $request->direction ='withdraw'; 
        }
        $data = [
            'date'=>$request->date, 
            'time'=>$request->time, 
            'amount'=>$request->amount,
            'direction'=>$request->direction,
            'details'=>$request->details,
            'transaction_type_id'=>$request->transaction_type
        ];
        //perpare old 'document image's path to delete
        $record =  $this->transactionProvider->GetByIdLimited($request->id); 
        $imagePath = $record[0]->document_image; 
        if ($imagePath && $request->has('documentImage')){
            //delete old document image 
            File::delete(public_path($imagePath)) ;
            //save document image file 
            $file = $request->file('documentImage'); 
            $path= 'assets/upload/DocumentsImages'; 
            $imageName = time().'.'.$file->extension(); 
            $file->move(public_path($path) , $imageName);
            $data['document_image'] = $path.'/'.$imageName ; 
        }else if ($request->has('documentImage')){
            $file = $request->file('documentImage'); 
            $path= 'assets/upload/DocumentsImages'; 
            $imageName = time().'.'.$file->extension(); 
            $file->move(public_path($path) , $imageName);
            $data['document_image'] = $path.'/'.$imageName ;
        }

        $this->transactionProvider->Update($data , $request->id); 
        return back()->with(['ok'=>'تم تحديث معاملة مالية رقم ( '.$request->id.' )']); 
    }
}
