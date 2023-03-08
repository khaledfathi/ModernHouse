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
}