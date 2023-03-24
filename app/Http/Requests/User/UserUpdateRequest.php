<?php

namespace App\Http\Requests\User;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Rules\UserNameOnUpdate;
use App\Rules\UserPhoneOnUpdate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required', new UserNameOnUpdate('users' , $this->id),'regex:/^[a-zA-Z]+$/'], 
            'password'=>'nullable|confirmed|min:8', 
            'phone'=>['required' , new UserPhoneOnUpdate('users' , $this->id) , 'numeric'],
            'type'=>['required', new Enum(UserType::class)],
            'status'=>[ 'required' , new Enum(UserStatus::class)],
        ];
    }
    public function messages(){
        return [
            'name.required'=>'الاسم مطلوب',
            'name.regex'=>'الاسم - حروف انجليزية فقط',
            'name'=>'الاسم مسجل مسبقاً', 
            'password.required'=>'كلمة المرور مطلوبة',
            'password.confirmed'=>'تأكيد كلمة المرور غير متطابق', 
            'password.min'=>'الحد الادنى لكلمة المرور 8 احرف',
            'phone.required'=>'التليفون مطلوب', 
            'phone.numeric'=>'التليفون - ارقام فقط',
            'phone'=>'رقم التليفون مسجل مسبقاً',
            'type.required'=>'النوع مطلوب',            
            'type'=>'النوع غير صالح',
            'status.required'=>'الحالة مطلوبة',
            'status'=>'الحالة غير صالحة'
        ]; 
    }
}
