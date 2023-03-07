<?php 
namespace App\Repository; 

use App\Repository\Contracts\CustomerRepoContract;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\CustomerModel;

class CustomerRepo implements CustomerRepoContract{
    
   public function store (CustomerRequest $request):CustomerModel
   {
        return CustomerModel::create([
            'name'=>$request->name, 
            'phone'=>$request->phone,
            'address'=>$request->addeess, 
            'coordinates'=>$request->coordinates
        ]); 
   }
}