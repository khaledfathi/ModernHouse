<?php 
namespace App\Repository;
use App\Http\Requests\User\UserRequest;
use App\Models\User as UserModel;
use App\Repository\Contracts\UserRepoContract;
use Illuminate\Support\Facades\Hash; 

class UserRepo implements UserRepoContract{
    public function GetAll():object
    {
        return UserModel::get(); 
    }
    public function GetById(string $id):object
    {
        return UserModel::where('id' , $id)->select('name')->first();
    }
    public function Store(UserRequest $request):UserModel
    {
        return UserModel::create([
           'name'=>$request->name ,
           'password'=> Hash::make($request->password),
           'phone'=>$request->phone,
           'type'=>$request->type,
           'status'=>$request->status
        ]); 
    }

    public function Destroy (string $id):bool
    {
        $found = UserModel::find($id); 
        if ($found){
            $found->delete(); 
            return true; 
        }
        return false ; 
    }
}