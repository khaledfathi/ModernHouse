<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetailsModel extends Model
{
    use HasFactory;
    public $table = 'bill_details';
    protected $fillable = [
        'product_name', 
        'price', 
        'quantity', 
        'total',
        'bill_id',
        'product_id' 
    ];
}
