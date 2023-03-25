<?php
namespace App\Repository;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\ProjectModel;
use App\Repository\Contracts\ProjectRepoContract; 

class ProjectRepo implements ProjectRepoContract {
    
    public function Store(ProjectRequest $request):ProjectModel
    {
        return ProjectModel::create([
            'date'=>$request->date,
            'start_date'=> $request->start_date, 
            'end_date'=>$request->end_date, 
            'amount'=> $request->amount, 
            'materials'=>$request->materials, 
            'details'=>$request->details, 
            'customer_id'=>$request->customer_id, 
            'user_id'=>auth()->user()->id, 
            'project_status_id'=>$request->project_status
        ]);  
    }
    public function GetById(string $id):object
    {
        return ProjectModel::Join('customers' , 'customers.id' , '=' , 'projects.customer_id')->
            join('project_status', 'projects.project_status_id', '=' , 'project_status.id')->
            select('projects.*' , 'customers.name' , 'customers.phone' , 'project_status.status')->
            where('projects.id' , '=' , $id)->get(); 
    }
    public function GetByCustomerId(string $id):object
    {
        return ProjectModel::join('customers' , 'customers.id' , '=' , 'projects.customer_id')->
            join('project_status', 'projects.project_status_id', '=' , 'project_status.id')->
            select('projects.*' , 'customers.name' , 'customers.phone' , 'project_status.status')->
            where('customers.id' , '=' , $id)->orderBy('id' , 'desc')->orderBy('date','desc')->get(); 
    }
    public function GetByCustomerName(string $name):object
    {
        return ProjectModel::join('customers' , 'customers.id' , '=' , 'projects.customer_id')->
            join('project_status', 'projects.project_status_id', '=' , 'project_status.id')->
            select('projects.*' , 'customers.name' , 'customers.phone' , 'project_status.status')->
            where('customers.name' , 'like' , '%'.$name.'%')->orderBy('date' ,'desc')->get(); 
    }
    public function GetByCustomerPhone(string $phone):object
    {
        return ProjectModel::join('customers' , 'customers.id' , '=' , 'projects.customer_id')->
            join('project_status', 'projects.project_status_id', '=' , 'project_status.id')->
            select('projects.*' , 'customers.name' , 'customers.phone' , 'project_status.status')->
            where('customers.phone' , '=' , $phone)->orderBy('date' ,'desc')->get(); 
    }
    public function GetProjectReportByProjectId(string $id):object
    {
        return ProjectModel::leftJoin('customers' , 'customers.id' , '=' , 'projects.customer_id')->
            join('project_status', 'projects.project_status_id', '=' , 'project_status.id')->
            Join('transactions' , 'transactions.project_id' ,'=', 'projects.id' )->
            where('projects.id' , '=' , $id)->select([
                'customers.id as customer_id',
                'customers.name as customer_name',
                'customers.phone as customer_phone',
                'projects.id as project_id', 
                'projects.date as project_date',
                'projects.start_date',
                'projects.end_date',
                'projects.amount as project_amount',
                'projects.materials',
                'projects.details',
                'transactions.date as transaction_date',
                'transactions.time',
                'transactions.amount as transaction_amount',
            ])->get(); 
     }
    public function Destroy(string $id):bool
    {
        $found = ProjectModel::find($id); 
        return ($found) ? $found->delete() : false ; 
    }
    public function Update(array $toUpdate , string $id):bool 
    {
        $found = ProjectModel::find($id); 
        if($found){
            return $found->update($toUpdate); 
        }
        return false ; 
    }

}