<?php

namespace App\Http\Controllers;

use App\Models\SettingModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Spatie\DbDumper\Databases\MySql as MySqlDump;

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
    public function BackupPage(){
        return view('setting.backup'); 
    }
    public function ExportDatabase(){         
        $dbFileName = 'backup.sql'; 
        MySqlDump::create()
        ->setDbName(getenv('DB_DATABASE'))
        ->setUserName(getenv('DB_USERNAME'))
        ->setPassword(getenv('DB_PASSWORD'))
        ->dumpToFile('backup.sql');
        $file = public_path($dbFileName);        
        return response()->download(public_path($dbFileName) , 'backup_'.Carbon::now()->format('dmy_Hi').'.sql');
    }
    public function ImportDatabase(Request $request){
        $request->validate([
            'sqlFile'=>'required|mimes:txt,sql'
        ],[
            'sqlFile.required'=>'لم تقم بتحديد ملف', 
            'sqlFile,mimes'=>'صيغة الملف غير مدعومة' 
        ]); 
        //save file 
        $file = $request->file('sqlFile'); 
        $file->move(public_path() , 'backup.sql'); 
        
        //restore databse from uploaded file file 
        if (Artisan::call('db:restore') == 0 ){// 0 mean no errors
            return back()->with(['ok'=>'تم استرجاع قاعدة البيانات']);
        };
        return back()->withErrors('فشل فى عملية الاسترجاع'); 

    }
}
 