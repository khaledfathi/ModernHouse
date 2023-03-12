<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\ProductRepoContract;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productProvider ; 
    public function __construct(ProductRepoContract $productProvider)
    {
        $this->productProvider = $productProvider; 
    }
    public function ProductPage(){
        $records  = $this->productProvider->GetAll(); 
        return view('product.product' , ['records'=>$records]); 
    }
    public function AddProductPage(Request $request){
        return view('product.addProduct'); 
    }
}
