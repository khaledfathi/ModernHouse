<?php
namespace App\Repository; 
use App\Models\CategoryModel;
use App\Repository\Contracts\CategoryRepoContract;
use Illuminate\Http\Request;

class CategoryRepo implements CategoryRepoContract{
    public function GetAll():object 
    {
        return CategoryModel::orderBy('id' , 'asc')->get(); 
    }
    public function Store(Request $request):CategoryModel
    {
        return CategoryModel::create([
            'name'=>$request->name
        ]); 
    } 
    public function Destroy (string $id):bool
    {
        $found = CategoryModel::find($id); 
        if ($found){
            return $found->delete(); 
        }
        return false ; 
    }
}

