<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function SettingPage(){
        $logos = SettingModel::where('key' , 'logo')->get(); 
        return view('setting.setting', ['logos'=>$logos]); 
    }
    public function UpdateLogo(Request $request){
        $request->validate([
                'logoImage' => 'required|mimes:jpeg,jpg,png,gif,webp,tif,tiff|max:256' // max 10000kb/10MB
            ],[
                'logoImage.required'=>'لم يتم اختيار شعار',
                'logoImage.mimes'=>'صيغة الملف غير مدعومة' ,
                'logImage.max'=>'اقصى مساحة للصورة 256 كيلوبايت'
            ]); 
        //delete old logo 
        $oldLogoPath = SettingModel::where('key' , 'logo')->select('value')->first()->value;
        File::delete($oldLogoPath); 
        $file = $request->file('logoImage');
        $path = 'assets/upload/logoImage/'; 
        $fileName = time().'.'.$file->extension();
        $file->move($path , $fileName);
        SettingModel::where('key', 'logo')->update(
            ['value'=>$path.$fileName]
        );
        return back()->with(['ok'=>'تم تغيير الشعار']); 
    }
}
 