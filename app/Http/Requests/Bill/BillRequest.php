<?php

namespace App\Http\Requests\Bill;

use Illuminate\Foundation\Http\FormRequest;

class BillRequest extends FormRequest
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
            'time' => 'required|date_format:H:i',
            'customerName' => 'required', 
            'customerPhone' => 'required',
            // 'products' => 'required',
        ];
    }
    public function messages(){
        return [
            'date.required'=> 'التاريخ مطلوب',
            'date.date'=>'صيغة التاريخ غير صالحة',
            'time.required'=>'الوقت مطلوب',
            'time.date_format'=>'صيغة الوقت غير صالحة',
            'customerName.required' => 'اسم العميل مطلوب',
            'customerPhone.required'=>'تليفون العميل مطلوب',
            'products'=>'لا يوجد منتجات لاصدار الفاتورة'
        ]; 
    }
}
