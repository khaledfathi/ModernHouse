<?php
namespace App\Repository;

use App\Http\Requests\Product\ProductRequest;
use App\Models\ProductModel;
use App\Repository\Contracts\ProductRepoContract; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductRepo implements ProductRepoContract{
    public function Store(ProductRequest $request):ProductModel
    {
        return ProductModel::create([
            'name' => $request->name, 
            'category_id'=>$request->category, 
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
    public function GetByName(string $name):object
    {
        return ProductModel::where('name' , 'like' , '%'.$name.'%')->get(); 
    }
    public function GetByCategoryId(string $category_id):object
    {
        return ProductModel::where('category_id' , $category_id)->get(); 
    }
    public function Destroy(string $id):bool 
    {
        $found = ProductModel::find($id); 
        $defaultImage = config('constants.defaultProductImagePath');
        if ($found){
            if ($found->image != $defaultImage){
                File::delete(public_path($found->image)); 
            }
            return $found->delete(); 
        }
        return false; 
    }
    public function Update(array $data , string $id):bool
    {
        $defaultImage = config('constants.defaultProductImagePath');
        $found = ProductModel::find($id);
        if ($found){
            $currentImage = $found->image; 
            if ( $found->image && ($found->image != $defaultImage) && $data['image'] &&$currentImage != $data['image']){
                File::delete(public_path($found->image));
                return $found->update($data); 
            }elseif(! $data['image']) {
                $data['image'] = $currentImage; 
                return $found->update($data); 
            }
            return $found->update($data); 
        }
        return false ; 

    }
    
}