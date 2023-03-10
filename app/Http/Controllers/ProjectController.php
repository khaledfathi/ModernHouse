<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\ProjectStatusModel;
use App\Repository\Contracts\ProjectRepoContract;
use App\Repository\Contracts\TransactionRepoContract;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $projectProvider ; 
    private $transactionProvider; 
    public function __construct(
        ProjectRepoContract $projectProvider,
        TransactionRepoContract $transactionProvider
        )
    {
        $this->projectProvider = $projectProvider; 
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
       
        if ($request->direction== 'saveAndAddPay'){        
            session(['project'=>$record]); 
            return redirect('payment'); 
        }
        session()->remove('customer'); 
        return redirect('customer/'.$record->customer_id)->with(['ok'=>"تم حفظ المشروع ( رقم  $record->id )"]); 
    }
    public function PaymentPage(){
        return view('project.payment'); 
    }
    public function NewPayment(TransactionRequest $request){
        $this->transactionProvider->StoreNewProjectPayment($request); 
        return "تم الحفظ بنجاح <br> it will return to customer page with his projects"; 
    }
    public function ProjectProfile($request){
        $customer=null; 
        $project=null; 
        return view('project.projectProfile' ,['customer'=>$customer , 'project'=>$project]); 
    }
}
