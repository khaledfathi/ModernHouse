<?php 
namespace App\Repository;
use App\Enums\PaymentDirection;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Requests\Transaction\TransactionRequestWithType;
use App\Models\TransactionModel;
use App\Repository\Contracts\TransactionRepoContract;
use Illuminate\Support\Carbon;


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
    public function StoreTransaction (TransactionRequestWithType $request):TransactionModel
    {
        return TransactionModel::create([
            'user_id'=>auth()->user()->id,
            'transaction_type_id'=> $request->transaction_type,
            'date' => $request->date, 
            'time'=>$request->time,
            'amount'=>$request->amount, 
            'direction'=>$request->direction,
            'details'=>$request->details

        ]); 
    } 
    public function GetAll():object
    {
        return TransactionModel::get(); 
    }
    public function GetTodayBalance():int
    {
        return TransactionModel::where('date' , Carbon::now()->format('y-m-d'))->sum('amount') ; 
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