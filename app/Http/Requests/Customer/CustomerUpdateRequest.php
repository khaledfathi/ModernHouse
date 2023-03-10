<?php

namespace App\Http\Requests\Customer;

use App\Rules\CustomerPhoneOnUpdate;
use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>['required','numeric', new CustomerPhoneOnUpdate('customers' ,$this->id )],
            'coordinates'=>'nullable|url'
        ];
    }
    public function messages() :array
    {
        return [
            'name.required'=>'حقل الاسم مطلوب',
            'phone.required'=>'حقل التليفون مطلوب',
            'phone.numeric'=>'رقم التليفون غير صحيح',
            'phone.unique'=>'رقم التليفون مسجل بالفعل',
            'coordinates'=>'رابط الموقع غير صالح'
        ];
    } 
}
