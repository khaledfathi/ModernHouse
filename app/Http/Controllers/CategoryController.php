<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\CategoryRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryProvider ; 
    public function __construct(CategoryRepoContract $categoryProvider)
    {
        $this->categoryProvider = $categoryProvider;  
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
        if ($this->categoryProvider->Destroy($request->id)) {
            return redirect('category')->with(['ok'=>'تم حذف الصنف رقم ( '.$request->id.' )']); 
        }
        return redirect('category')->withErrors('لم يتم العثور على هذا الصنف'); 
    }
    public function UpdateCategory(Request $request){
        return $request->id; 
    }
}
