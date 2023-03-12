<?php
namespace App\Repository;

use App\Models\ProductModel;
use App\Repository\Contracts\ProductRepoContract; 
use Illuminate\Http\Request;

class ProductRepo implements ProductRepoContract{
    public function Store(Request $request):ProductModel
    {
        return new ProductModel; 
    } 
    public function GetAll():object
    {
        return ProductModel::get();    
    }
}