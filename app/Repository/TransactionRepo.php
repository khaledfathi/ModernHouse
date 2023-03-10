<?php 
namespace App\Repository;
use App\Enums\PaymentDirection;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\TransactionModel;
use App\Repository\Contracts\TransactionRepoContract;


class TransactionRepo implements TransactionRepoContract 
{

    public function StoreNewProjectPayment(TransactionRequest $request):TransactionModel
    {
        return TransactionModel::create([
            'user_id'=>auth()->user()->id,
            'transaction_type_id'=>config('constants.transaction_type.payforproject'),
            'project_id' => $request->project_id, 
            'date' => $request->date, 
            'time'=>$request->time,
            'amount'=>$request->amount, 
            'direction'=>'deposit',
            'details'=>$request->details
        ]); 
    } 
}