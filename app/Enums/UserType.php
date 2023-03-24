<?php 

namespace App\Enums; 

enum UserType : string
{
    case admin = 'admin'; 
    case user = 'user'; 
}