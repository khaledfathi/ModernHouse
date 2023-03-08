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
            'address'=>$request->address, 
            'coordinates'=>$request->coordinates,
            'details'=>$request->details,
        ]); 
   }
   public function getById(string $id):object
   {
        return CustomerModel::where('id' , $id)->get(); 
   }
   public function getByName(string $name):object
   {
     return CustomerModel::where('name' , 'like' , '%'.$name.'%')->get(); 
   }
   public function getByPhone(string $phone):object
   {
     return CustomerModel::where('phone' , $phone)->get(); 
   }

}