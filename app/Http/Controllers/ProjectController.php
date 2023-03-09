<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerRequest;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\ProjectStatusModel;
use App\Repository\Contracts\ProjectRepoContract;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $projectProvider ; 
    public function __construct(ProjectRepoContract $projectProvider){
        $this->projectProvider = $projectProvider; 
    }
    public function ProjectPage ()
    {
        $projectStatus = ProjectStatusModel::get(); 
        return  view('project.project' ,['projectStatus' => $projectStatus]);
    }
    public function NewProject(ProjectRequest $request)
    {
        $record = $this->projectProvider->store($request); 
        
        if ($request->direction== 'saveAndAddPay'){        
            $record->customer_id = session('customer')->id; 
            $record->customer_name = session('customer')->name; 
            $record->customer_phone = session('customer')->phone; 
            session(['project'=>$record]); 
            return redirect('payment'); 
        }
        session()->remove('customer'); 
        return back()->with(['ok'=>'تم الحفظ بنجاح' , 'id'=>$record->id]); 
    }
    public function PaymentPage(){
        return view('project.payment'); 
    }
}
