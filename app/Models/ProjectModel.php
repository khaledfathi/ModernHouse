<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    use HasFactory;
    public $table = 'projects'; 
    protected $fillable =[
        'date', 
        'start_date', 
        'end_date', 
        'amount', 
        'materials', 
        'details',
        'user_id',
        'customer_id', 
        'project_status_id'        
    ];
}