<?php 
namespace App\Repository\Contracts;
use App\Http\Requests\User\UserRequest;
use App\Models\User as UserModel; 

interface UserRepoContract {
    public function GetAll():object; 
    public function GetById(string $id):object;
    public function Store(UserRequest $request):UserModel; 
    public function Destroy (string $id):bool; 
}