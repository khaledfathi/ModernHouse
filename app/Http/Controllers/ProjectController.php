<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\CustomerRequest;
use App\Models\ProjectStatusModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function ProjectPage (){
        $projectStatus = ProjectStatusModel::get(); 
        return  view('project.project' ,['projectStatus' => $projectStatus]);
    }
}
