<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\CategoryRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Rules\CategoryNameOnUpdate; 

class CategoryController extends Controller
{
    private $categoryProvider ; 
    private $productProvider; 
    public function __construct(
        CategoryRepoContract $categoryProvider,
        ProductRepoContract $productProvider )
    {
        $this->categoryProvider = $categoryProvider;  
        $this->productProvider= $productProvider;
    }
     public function CategoryPage(){
        $categories = $this->categoryProvider->GetAll(); 
        return view('category.category' ,['categories'=>$categories]); 
    }
    public function NewCategory(Request $request)
    {
        $request->validate([
                'name'=>'required|unique:categories',
            ],
            [
                'name.required'=>'اسم الصنف مطلوب',
                'name.unique'=>'اسم الصنف مسجل مسبقاً'
            ]); 
        $record = $this->categoryProvider->Store($request); 
        return back()->with(['ok'=>'تم حفظ صنف رقم ( '.$record->id.' )']) ;  
    }
    public function DestroyCategory(Request $request)
    {        
        $products = $this->productProvider->GetByCategoryId($request->id); 

        if ($this->categoryProvider->Destroy($request->id)) {            
            //delete product images related to this category 
            foreach ($products as $product){
                File::delete(public_path($product->image)); 
            }
            //then delete and return 
            return redirect('category')->with(['ok'=>'تم حذف الصنف رقم ( '.$request->id.' )']); 
        }
        return redirect('category')->withErrors('لم يتم العثور على هذا الصنف'); 
    }
    public function CategoryProfile (Request $request){
        $record = $this->categoryProvider->GetById($request->id); 
        if($record->count()){
            $record = $record[0];
        }else{
            $record= null ; 
        }
        return view('category.categoryProfile' , ['record'=>$record]); 
    }
    public function UpdateCategory(Request $request){
        $request->validate([
            'name'=>['required', new CategoryNameOnUpdate('categories',$request->id)]
        ],[
            'name.required'=> 'اسم الصنف مطلوب',
            'name.unique'=> 'اسم الصنف مسجل مسبقاً' 
        ]);
        $this->categoryProvider->Update(['name'=>$request->name], $request->id); 
        return redirect('category')->with(['ok'=>'تم تحديث الصنف رقم ( '.$request->id.' )']); 
    }
}
