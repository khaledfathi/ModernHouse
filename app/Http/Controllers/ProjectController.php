<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\ProjectStatusModel;
use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use App\Repository\Contracts\TransactionRepoContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    private $projectProvider ;
    private $customerProvider;
    private $transactionProvider;
    public function __construct(
        ProjectRepoContract $projectProvider,
        TransactionRepoContract $transactionProvider,
        CustomerRepoContract $customerProvider
        )
    {
        $this->projectProvider = $projectProvider; 
        $this->customerProvider = $customerProvider; 
        $this->transactionProvider = $transactionProvider;
    }
    public function ProjectPage ()
    {
        $projectStatus = ProjectStatusModel::get(); 
        return  view('project.project' ,['projectStatus' => $projectStatus]);
    }
    public function NewProject(ProjectRequest $request)
    {
        $record = $this->projectProvider->store($request); 
        $record->customer_id = session('customer')->id; 
        $record->customer_name = session('customer')->name; 
        $record->customer_phone = session('customer')->phone; 
        Session::forget('customer'); 
        if ($request->direction== 'saveAndAddPay'){        
            session(['project'=>$record]); 
            return redirect('payment'); 
        }
        return redirect('customer/'.$record->customer_id)->with(['ok'=>"تم حفظ المشروع ( رقم  $record->id )"]); 
    }
    public function PaymentPage(){
        return view('project.payment'); 
    }
    public function NewPayment(TransactionRequest $request){
        $this->transactionProvider->StoreNewProjectPayment($request);
        Session::forget('project'); 
        return redirect("project/$request->project_id"); 
    }
    public function ProjectProfile(Request $request){
        $customer=null; 
        $remaining=null; 
        $transactions = null ; 
        $project = $this->projectProvider->GetById($request->id); 
        $projectStatus = ProjectStatusModel::get(); 
        if ($project->count()){
            $project = $project[0]; 
            $customer = $this->customerProvider->GetById($project->customer_id)[0];            
            $transactions = $this->transactionProvider->GetByProjectId($project->id); 
            if ( ! $transactions->count() ) $transactions = null ; 
            //for transaction page 
            $record=$project; 
            $record->customer_id = $customer->id; 
            $record->customer_name = $customer->name; 
            $record->customer_phone = $customer->phone; 
            session(['project'=>$record]); 
            /******************/

            $amountPaid = $this->transactionProvider->GetByProjectId($request->id)->sum('amount'); 
            $remaining= $project->amount - $amountPaid; 
        }else {
            $project = null; 
        }
        return view('project.projectProfile' ,[
            'customer'=>$customer ,
            'project'=>$project ,
            'transactions'=>$transactions,
            'projectStatus' => $projectStatus ,
            'remaining'=>$remaining,
        ]); 
    }
    public function DeleteProject(Request $request){        
        $this->projectProvider->Destroy($request->id); 
        return redirect('customer/'.$request->customer_id)->with(['ok'=> 'تم حذف المشروع رقم ( '.$request->id.' )']); 
    }
    public function UpdateProject(ProjectRequest $request){
        $toUpdate = [
            'date'=>$request->date,
            'start_date'=>$request->start_date, 
            'end_date'=>$request->end_date, 
            'amount'=>$request->amount, 
            'materials'=>$request->materials, 
            'details'=>$request->details ,
            'project_status_id'=>$request->project_status
        ]; 
        $this->projectProvider->Update($toUpdate , $request->id); 
        return back()->with(['ok'=>'تم تحديث البيانات']);
    }
    public function PaymentProfile(Request $request){
        $found = $this->transactionProvider->GetById($request->id); 
        if ($found->count() && $request->has(['customer_id' , 'project_id'])){ 
            $transaction = $found[0]; 
            $customer= $this->customerProvider->GetById($request->customer_id)[0] ; 
            $project= $this->projectProvider->GetById($request->project_id)[0];
            $remaining = $project->amount - $this->transactionProvider->GetByProjectId($project->id)->sum('amount'); 
            return view('project.paymentUpdate' , ['transaction'=>$transaction , 'customer'=>$customer , 'project'=>$project , 'remaining'=>$remaining]);
        };    
        return redirect('/'); 
    }
    Public function UpdatePayment(TransactionRequest $request){
        $toUpdate = [
            'date'=>$request->date,
            'start_date'=>$request->start_date, 
            'end_date'=>$request->end_date, 
            'amount'=>$request->amount, 
            'materials'=>$request->materials, 
            'details'=>$request->details ,
            'project_status_id'=>$request->project_status
        ]; 
        $this->transactionProvider->Update($toUpdate , $request->id); 
        return redirect('project/'.$request->project_id)->with(['ok'=>'تم تحديث معاملة مالية رقم ( '.$request->id.' )']);
    }
    public function DeletePayment(Request $request){
        $this->transactionProvider->Destroy($request->id); 
        return redirect('project/'.$request->project_id)->with(['ok'=>'تم حذف العملية المالية رقم ( '.$request->id.' )']); 
    }
}
