<?php
namespace App\Repository\Contracts;
use App\Http\Requests\Product\ProductRequest;
use App\Models\ProductModel;
use Illuminate\Http\Request;

interface ProductRepoContract {
    public function Store(ProductRequest $request):ProductModel; 
    public function GetAll():object; 
    public function GetByName(string $name):object; 
    public function GetById(string $id):object ; 
    public function GetByCategoryId(string $category_id):object; 
    public function Destroy(string $id):bool ; 
    public function Update(array $data , string $id):bool; 
    public function UpdateQuantity (string $quantity , string $id):bool; 
}