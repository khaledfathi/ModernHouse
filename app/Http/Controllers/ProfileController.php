<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use App\Rules\UserPhoneOnUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfilePage(){
        $phone = UserModel::where('id' , auth()->user()->id )->select('phone')->first()->phone; 
        return view('profile.profile' , ['phone'=>$phone]); 
    }
    public function ChangePassword(Request $request){
        $request->validate([
            'password'=>'required|confirmed|min:8'
        ],
        [
            'password.required'=>'خطأ فى الادخال',
            'password.confirmed'=>'تأكيد كلمة المرور غير متطابق',
            'password.min' => 'كلمة المرور 8 احرف على الاقل'
        ]);
        if(Hash::check($request->oldPassword , auth()->user()->getAuthPassword()) ){
            UserModel::find( auth()->user()->id ) ->update(['password'=>Hash::make($request->password)]);
            return back()->with(['ok'=>'تم تغيير كلمة المرور']);
        }
        return back()->withErrors('كلمة المرور غير صحيحة');
    }
    public function ChangePhone(Request $request){
        $request->validate([
            'phone'=>['required','numeric', new UserPhoneOnUpdate('users', auth()->user()->id)]
        ],
        [
            'phone.required'=>'التليفون مطلوب',
            'phone.numeric'=>'التليفون - ارقام فقط',
            'phone.unique'=>'رقم التليفون مسجل بالفعل'
        ]); 
        UserModel::find( auth()->user()->id ) ->update(['phone'=>$request->phone]); 
        return back()->with(['ok'=>'تم تعديل رقم التليفون']);
    }
}
