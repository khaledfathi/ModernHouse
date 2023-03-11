<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id', 
            'date' => 'required|date', 
            'time'=>'required|date_format:H:i',
            'amount'=>'required|numeric|not_in:0', 
            'remaining'=>'gte:0'
        ];
    }
    public function messages(){
        return [
            'project_id.required'=>'رقم المشروع مطلوب',
            'project_id.exists'=>'رقم المشروع غير صالح',
            'date.required'=>'التاريخ مطلوب',
            'date.date'=>'التاريخ غير صالح',
            'time.required'=>'الوقت مطلوب',
            'time.date_format'=>'صيغة الوقت غير صالحة',
            'amount.required'=>'المبلغ مطلوب',
            'amount.numeric'=>'المبلغ - ارقام فقط', 
            'amount.not_in'=>'المبلغ لايمكن ان يكون صفر',
            'remaining.gte'=>'المبلغ المدخل اكبر من المستحق'
        ]; 
    }
}
