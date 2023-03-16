<?php 
namespace App\Enums; 

enum PaymentDirection : string 
{
    case deposit = 'deposit';
    case withdraw = 'withdraw';
}