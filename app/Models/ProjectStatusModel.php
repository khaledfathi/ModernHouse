<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatusModel extends Model
{
    use HasFactory;
    public $table = 'project_status';
    protected $fillable =[
        'status'
    ]; 
}
