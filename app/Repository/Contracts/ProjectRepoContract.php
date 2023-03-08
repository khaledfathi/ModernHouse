<?php
namespace App\Repository\Contracts;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\ProjectModel;

interface ProjectRepoContract {
    public function Store(ProjectRequest $request):ProjectModel;
}
