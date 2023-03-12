<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CustomerPhoneOnUpdate implements ValidationRule
{
    private $table;
    private $id; 
    public function __construct(string $table=null ,string $id=null){
        $this->table = $table; 
        $this->id = $id; 
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {        
        $currentValue = DB::table($this->table)->where('id' , $this->id)->first()->$attribute; 
        $isExist = DB::table($this->table)->where($attribute , $value)->where($attribute , '!=' , $currentValue)->count(); 
        if ($isExist){
            $fail('رقم التليفون مسجل مسبقاً'); 
        }
    }
}
