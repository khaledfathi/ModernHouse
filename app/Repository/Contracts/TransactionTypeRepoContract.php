<?php 
namespace App\Repository\Contracts;


interface TransactionTypeRepoContract 
{
    public function GetAll():object; 
    public function GetWhereNotInList (array $list):object; 
}