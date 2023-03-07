<?php
namespace App\Repository\Contracts;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\CustomerModel; 

interface CustomerRepoContract{
   public function store(CustomerRequest $request):CustomerModel;
}