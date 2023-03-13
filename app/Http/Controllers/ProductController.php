<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Repository\Contracts\ProductRepoContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
    public function NewProduct(ProductRequest $request){
        //save file
        if ($request->image){
            $file = $request->file('image'); 
            $path = 'assets/upload/productsImages';
            $imageName = time().'.'.$file->extension(); 
            $request->file('image')->move(public_path($path) , $imageName); 
            $request->image=$path.'/'.$imageName; 
        }else{
            $request->image = 'assets/images/default/default.jpg';
        }
        $record = $this->productProvider->Store($request); 
        return redirect('product')->with(['ok'=>'تم حفظ منتج رقم ( '.$record->id.' )']); 
    }
    public function DeleteProduct(Request $request)
    {
        $this->productProvider->Destroy($request->id); 
        return back()->with(['ok'=>'تم حذف منتج رقم ( '.$request->id.' )']); 
    } 
    public function  ProductProfile(Request $request)
    {
        $record = $this->productProvider->GetById($request->id); 
        ($record->count()) ? $record = $record[0] : $record = null ; 
        return view('product.productProfile' , ['record'=>$record]) ;
    }
    public function UpdateProduct(ProductRequest $request){
        // File::delete(public_path('assets/upload/productsImages/1678666667.png')); 

        //save file
        if ($request->image){
            $file = $request->file('image'); 
            $path = 'assets/upload/productsImages';
            $imageName = time().'.'.$file->extension(); 
            $request->file('image')->move(public_path($path) , $imageName); 
            $request->image=$path.'/'.$imageName; 
        }else{
            $request->image = 'assets/images/default/default.jpg';
        }
        $data =[
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'image'=>$request->image,
        ];
        $this->productProvider->Update($data, $request->id);
        return redirect('product'); 
    }
}
