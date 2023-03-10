<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionTypeModel extends Model
{
    use HasFactory;
    public $table= 'transaction_types';
    protected $fillable = [
        'type'
    ];
}
