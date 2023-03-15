<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Repository\Contracts\CategoryRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    private $productProvider ; 
    private $categoryProvider ; 
    public function __construct(
        ProductRepoContract $productProvider,
        CategoryRepoContract $categoryProvider
        )
    {
        $this->productProvider = $productProvider; 
        $this->categoryProvider = $categoryProvider; 
    }
    public function ProductPage(){
        $records  = $this->productProvider->GetAll(); 
        $categories = $this->categoryProvider->GetAll(); 
        return view('product.product' , ['records'=>$records , 'categories'=>$categories]); 
    }
    public function AddProductPage(Request $request){
        $categories = $this->categoryProvider->GetAll(); 
        return view('product.addProduct' , ['categories'=>$categories]); 
    }
    public function NewProduct(ProductRequest $request){        
        if ($request->image){
            //save file and get path 
            $file = $request->file('image'); 
            $path = 'assets/upload/productsImages';
            $imageName = time().'.'.$file->extension(); 
            $request->file('image')->move(public_path($path) , $imageName); 
            $request->image=$path.'/'.$imageName; 
        }else{
            $request->image = 'assets/images/default/default.jpg';
        }
        $record = $this->productProvider->Store($request); 
        return redirect('product'); 
    }
    public function DeleteProduct(Request $request)
    {
        $this->productProvider->Destroy($request->id); 
        return redirect('product')->with(['ok'=>'تم حذف منتج رقم ( '.$request->id.' )']); 
    } 
    public function  ProductProfile(Request $request)
    {
        $record = $this->productProvider->GetById($request->id); 
        $categories = $this->categoryProvider->GetAll(); 
        ($record->count()) ? $record = $record[0] : $record = null ; 
        return view('product.productProfile' , ['record'=>$record , 'categories'=>$categories]) ;
    }
    public function UpdateProduct(ProductRequest $request){
        if ($request->image){
            //save image and get path
            $file = $request->file('image'); 
            $path = 'assets/upload/productsImages';
            $imageName = time().'.'.$file->extension(); 
            $request->file('image')->move(public_path($path) , $imageName); 
            $request->image=$path.'/'.$imageName; 
        }
        $data =[
            'name'=>$request->name,
            'category_id'=>$request->category,
            'description'=>$request->description,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'image'=>$request->image,
        ];
        $this->productProvider->Update($data, $request->id);
        return redirect('product'); 
    }
}
