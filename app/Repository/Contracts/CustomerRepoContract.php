<?php
namespace App\Repository\Contracts;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\CustomerModel; 

interface CustomerRepoContract{
   public function Store(CustomerRequest $request):CustomerModel;
   public function GetById(string $id):object;
   public function GetByName(string $name):object;
   public function GetByPhone(string $phone):object;
   public function Destroy(string $id):bool; 
   public function Update(array $toUpdate , string $id):bool; 
}