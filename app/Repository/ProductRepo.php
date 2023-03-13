<?php
namespace App\Repository;

use App\Http\Requests\Product\ProductRequest;
use App\Models\ProductModel;
use App\Repository\Contracts\ProductRepoContract; 
use Illuminate\Http\Request;

class ProductRepo implements ProductRepoContract{
    public function Store(ProductRequest $request):ProductModel
    {
        return ProductModel::create([
            'name' => $request->name, 
            'description' => $request->description,             
            'price'=> $request->price,
            'quantity'=>$request->quantity,
            'image' => $request->image
        ]); 
    } 
    public function GetAll():object
    {
        return ProductModel::orderBy('id','desc')->get();
    }
    public function GetById(string $id):object 
    {
        return ProductModel::where('id' , $id)->get(); 
    }
    public function Destroy(string $id):bool 
    {
        $found = ProductModel::find($id); 
        if ($found){
            return $found->delete(); 
        }
        return false; 
    }
    public function Update(array $data , string $id):bool
    {
        $found = ProductModel::find($id);
        if ($found){
            return $found->update($data); 
        }
        return false ; 

    }
    
}