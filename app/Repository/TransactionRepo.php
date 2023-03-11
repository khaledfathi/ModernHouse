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
    public function GetById(string $id):object
    {
        return TransactionModel::where('id' , $id)->get(); 
    }
    public function GetByProjectId(string $id):object
    {
        return TransactionModel::where('project_id' , $id)->get(); 
    }
    public function Update(array $toUpdate , string $id):bool
    {
        $found = TransactionModel::find($id); 
        if($found){
            return  $found->update($toUpdate) ; 
        }
        return false ; 
    }
    public function Destroy(string $id):bool 
    {
        $found = TransactionModel::find($id); 
        if ($found){
            return $found->delete(); 
        }
        return false ; 
    }
}