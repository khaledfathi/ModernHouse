<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repository\Contracts\UserRepoContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagmentController extends Controller
{
    private $userProvider ; 
    public function __construct(UserRepoContract $userPovider){
        $this->userProvider = $userPovider ; 
    }
    public function UserManagmentPage()
    {
        $records = $this->userProvider->GetAll();
        return view('userManagment.userManagment' , ['records'=>$records]); 
    }
    public function UserPage(Request $requset)
    {
        $userTypes = UserType::cases() ; 
        $userStatus = UserStatus::cases(); 
        return view('userManagment.user', ['userTypes'=>$userTypes , 'userStatus'=>$userStatus]);
    }
    public function NewUser(UserRequest $request){
        $record = $this->userProvider->Store($request); 
        return redirect('usersmanagment')->with(['ok'=>'تم حفظ المستخدم " '.$record->name.' " ']); 
    }    
    public function DestroyUser(Request $request)
    {
        if ($request->id == auth()->user()->id){
            return redirect('usersmanagment')->withErrors('لا يمكن حذف نفسك !'); 
        }else {
            $record=$this->userProvider->GetById($request->id); 
            $this->userProvider->Destroy($request->id);
            return redirect('usersmanagment')->with(['ok'=>'تم حذف المستخدم ( '.$record->name.' )']); 
        }
    }
    public function UserProfile(Request $request){
        $record = $this->userProvider->GetById($request->id); 
        $userTypes = UserType::cases() ; 
        $userStatus = UserStatus::cases(); 
        return view('userManagment.userProfile', ['record' => $record , 'userTypes'=>$userTypes , 'userStatus'=>$userStatus ]);
    }
    public function UpdateUser(UserUpdateRequest $request){
        $data = [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'type'=>$request->type,
            'status'=>$request->status
        ];
        //check password
        if ($request->password){
            $request->validate(
                [
                'password'=>'confirmed|min:8'
                ],[
                'password.confirmed'=>'تأكيد كلمة المرور غير متطابق', 
                'password.min'=>'الحد الادنى لكلمة المرور 8 احرف',
                ]
            ); 
            $data['password']= Hash::make($request->password); 
        }   
        $this->userProvider->Update($data , $request->id); 
        return back()->with(['ok'=>'تم تحديث بيانات المستخدم']); 
    }
}
