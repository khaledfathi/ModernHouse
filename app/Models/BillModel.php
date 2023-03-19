<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillModel extends Model
{
    use HasFactory;
    public $table = 'bills'; 
    protected $fillable =[
        'customer_name', 
        'customer_phone', 
        'date', 
        'time', 
        'status',
        'customer_id',
        'user_id'
    ];
}
