<?php

namespace App\Http\Controllers;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Http\Requests\User\UserRequest;
use App\Repository\Contracts\UserRepoContract;
use Illuminate\Http\Request;

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
}
