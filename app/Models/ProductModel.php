<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    public $table = 'products'; 
    protected $fillable = [
        'name',
        'category_id',
        'description', 
        'price', 
        'quantity',
        'image',
    ]; 
}
