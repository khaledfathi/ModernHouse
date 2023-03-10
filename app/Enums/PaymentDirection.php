<?php 
namespace App\Enums; 

enum PaymentDirection{
    case deposit = 'deposit';
    case withdraw = 'withdraw';
}