<?php

namespace App\Http\Controllers;

use App\Models\ProjectStatusModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function ProjectPage (Request $request){
        $projectStatus = ProjectStatusModel::get(); 
        return  view('project.project' ,['projectStatus' => $projectStatus ]); 
    }
}
