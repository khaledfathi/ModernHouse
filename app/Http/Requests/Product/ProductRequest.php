<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category'=>'required|numeric|exists:categories,id',
            'price'=>'required|numeric|not_in:0',
            'quantity' => 'required|numeric',            
            'image' => 'nullable|mimes:jpeg,jpg,png,gif,webp,tif,tiff|max:10000' // max 10000kb/10MB
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'اسم المنتج مطلوب',
            'category.required'=>'الصنف مطلوب',
            'category.numeric'=>'الصنف غير صالح',
            'category.exists'=>'الصنف غير صالح',
            'price.required'=>'السعر مطلوب',
            'price.numeric'=>'السعر - ارقام فقط',
            'price.not_in'=>'السعر لا يمكن ان يكون صفر',
            'quantity.required' => 'الكمية مطلوبة',
            'quantity.numeric'=> 'الكمية- ارقام فقط', 
            'image.mimes'=>'صيغة الصورة غير مدعومة',
            'image.max' => 'الحد الاقصى للصورة 10 ميجابايت'
        ]; 
    }
}
