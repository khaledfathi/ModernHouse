<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'date'=>'required|date',
            'start_date'=>'date|nullable',
            'end_date'=>'date|nullable',
            'amount'=>'required|numeric|not_in:0',
            'project_status' => 'required|numeric',
            'customer_id'=>'required|numeric'
        ];
    }

    public function messages(){    
        return [
            'date.required'=>'تاريخ التعاقد مطلوب',
            'date.date'=>'تاريخ التعاقد - تاريخ فقط',
            'start_date.date'=>'تاريخ البدء - تاريخ فقط',
            'date_date.date'=>'تاريخ التسليم - تاريخ فقط',
            'amount.required'=>'المبلغ مطلوب',
            'amount.numeric'=>'المبلغ - ارقام فقط',
            'amount.not_in'=>'المبلغ لا يمكن ان يكون صفر',
            'project_status.required'=>'حالة المشروع مطلوبة',
            'project_status.numeric'=>'حالة المشروع غير معروفة',
            'customer_id.required'=>'رقم العميل مطلوب',
            'customer_id.numeric'=>'رقم العميل غير صالح'
        ]; 
    }
}
