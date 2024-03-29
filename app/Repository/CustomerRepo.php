<?php 
namespace App\Repository; 

use App\Repository\Contracts\CustomerRepoContract;
use App\Http\Requests\Customer\CustomerRequest;
use App\Models\CustomerModel;

class CustomerRepo implements CustomerRepoContract{
   
   function Store (CustomerRequest $request):CustomerModel
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
   function StoreFromBill(array $data):CustomerModel
   {
      return  CustomerModel::create([
         'name'=> $data['name'], 
         'phone'=>$data['phone'],
         'user_id'=>auth()->user()->id  
      ]); 
   }
   public function GetAll():object
   {
      return CustomerModel::get(); 
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
   public function Destroy(string $id):bool
   {
      $record = CustomerModel::find($id); 
      if ($record) return $record->delete(); 
      return false ; 
   }
   public function Update(array $toUpdate , string $id):bool
   {
      $found =  CustomerModel::find($id); 
      if ($found){
         return ($found->update($toUpdate)); 
      }
      return true ; 
   }

}