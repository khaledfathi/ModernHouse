<?php 
namespace App\Repository; 

use App\Repository\Contracts\CustomerRepoContract;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\CustomerModel;

class CustomerRepo implements CustomerRepoContract{
    
   public function Store (CustomerRequest $request):CustomerModel
   {
        return CustomerModel::create([
            'name'=>$request->name, 
            'phone'=>$request->phone,
            'address'=>$request->address, 
            'coordinates'=>$request->coordinates,
            'details'=>$request->details,
            'user_id'=>auth()->user()->id,
        ]); 
   }
   public function GetById(string $id):object
   {
        return CustomerModel::where('id' , $id)->get(); 
   }
   public function GetByName(string $name):object
   {
     return CustomerModel::where('name' , 'like' , '%'.$name.'%')->get(); 
   }
   public function GetByPhone(string $phone):object
   {
     return CustomerModel::where('phone' , $phone)->get(); 
   }

}