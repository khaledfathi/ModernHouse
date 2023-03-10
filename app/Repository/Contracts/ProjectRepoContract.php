<?php
namespace App\Repository\Contracts;
use App\Http\Requests\Project\ProjectRequest;
use App\Models\ProjectModel;

interface ProjectRepoContract {
    public function Store(ProjectRequest $request):ProjectModel;
    public function GetById(string $id):object;
    public function GetByCustomerId(string $id):object; 
    public function GetByCustomerName(string $id):object;
    public function GetByCustomerPhone(string $id):object;
}
