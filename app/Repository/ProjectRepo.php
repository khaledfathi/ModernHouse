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
            where('customers.id' , '=' , $id)->orderBy('name' ,'asc')->get(); 
    }
    public function GetByCustomerName(string $name):object
    {
        return ProjectModel::join('customers' , 'customers.id' , '=' , 'projects.customer_id')->
            join('project_status', 'projects.project_status_id', '=' , 'project_status.id')->
            select('projects.*' , 'customers.name' , 'customers.phone' , 'project_status.status')->
            where('customers.name' , 'like' , '%'.$name.'%')->orderBy('name' ,'asc')->get(); 
    }
    public function GetByCustomerPhone(string $phone):object
    {
        return ProjectModel::join('customers' , 'customers.id' , '=' , 'projects.customer_id')->
            join('project_status', 'projects.project_status_id', '=' , 'project_status.id')->
            select('projects.*' , 'customers.name' , 'customers.phone' , 'project_status.status')->
            where('customers.phone' , '=' , $phone)->orderBy('name' ,'asc')->get(); 
    }

}