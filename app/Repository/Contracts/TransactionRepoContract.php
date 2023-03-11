<?php 

namespace App\Repository\Contracts;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\TransactionModel; 

interface TransactionRepoContract{
    public function StoreNewProjectPayment(TransactionRequest $request):TransactionModel; 
    public function GetById(string $id):object; 
    public function GetByProjectId(string $id):object; 
    public function Update(array $toUpdate , string $id):bool;
    public function Destroy(string $id):bool ; 
}