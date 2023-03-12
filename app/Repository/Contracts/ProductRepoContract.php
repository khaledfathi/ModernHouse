<?php
namespace App\Repository\Contracts;
use App\Models\ProductModel;
use Illuminate\Http\Request;

interface ProductRepoContract {
    public function Store(Request $request):ProductModel; 
    public function GetAll():object; 
}