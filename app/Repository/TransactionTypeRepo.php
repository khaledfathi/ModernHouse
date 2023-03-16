<?php 
namespace App\Repository;
use App\Models\TransactionTypeModel;
use App\Repository\Contracts\TransactionTypeRepoContract;


class TransactionTypeRepo implements TransactionTypeRepoContract 
{

    public function GetAll():object
    {
        return TransactionTypeModel::get(); 
    }
    public function GetWhereNotInList (array $list):object
    {
        return TransactionTypeModel::whereNotIn('id' , $list)->get(); 
    }
}