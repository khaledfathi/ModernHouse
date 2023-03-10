<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;
    public $table ='transactions'; 
    protected $fillable = [
        'date', 
        'time', 
        'amount',
        'direction', 
        'details', 
        'details', 
        'user_id', 
        'bill_id', 
        'project_id',
        'transaction_type_id'
    ]; 
}