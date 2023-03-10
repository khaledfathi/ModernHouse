<?php 

namespace App\Repository\Contracts;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\TransactionModel; 

interface TransactionRepoContract{
    public function StoreNewProjectPayment(TransactionRequest $request):TransactionModel; 
}