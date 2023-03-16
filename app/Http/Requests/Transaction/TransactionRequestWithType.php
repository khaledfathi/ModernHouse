<?php

namespace App\Http\Requests\Transaction;

use App\Enums\PaymentDirection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TransactionRequestWithType extends FormRequest
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
            'date' => 'required|date', 
            'time'=>'required|date_format:H:i',
            'amount'=>'required|numeric|not_in:0',
            'documentImage'=>'nullable|mimes:jpeg,jpg,png,gif,webp,tif,tiff|max:10000', //max file size 10MB
            'transaction_type'=>'required|exists:transaction_types,id',
            'direction'=> [ 'required' , new Enum(PaymentDirection::class)],

        ];
    }
    public function messages(){
        return [
            'date.required'=>'التاريخ مطلوب',
            'date.date'=>'التاريخ غير صالح',
            'time.required'=>'الوقت مطلوب',
            'time.date_format'=>'صيغة الوقت غير صالحة',
            'amount.required'=>'المبلغ مطلوب',
            'amount.numeric'=>'المبلغ - ارقام فقط', 
            'amount.not_in'=>'المبلغ لايمكن ان يكون صفر',
            'documentImage'=>'الحد الاقصى للصورة 10 ميجابايت',
            'mimes'=>'صيغة الملف غير مدعومة',
            'transaction_type.required'=>'نوع العميلة مطلوب',
            'transaction_type.exists'=>'نوع العملية غير صالح',
            'direction.required'=>'اتجاه العملية مطلوب',
            'direction'=>'اتجاه العملية غير معروف'
        ]; 
    }
}
