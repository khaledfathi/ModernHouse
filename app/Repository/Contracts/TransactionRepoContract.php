<?php 

namespace App\Repository\Contracts;
use App\Http\Requests\Transaction\TransactionRequest;
use App\Http\Requests\Transaction\TransactionRequestWithType;
use App\Models\TransactionModel; 

interface TransactionRepoContract{
    public function StoreNewProjectPayment(TransactionRequest $request):TransactionModel; 
   public function StoreNewInvoice(array $data):TransactionModel; 
    public function StoreTransaction (TransactionRequestWithType $request):TransactionModel; 
    public function GetAll():object; 
    public function GetAllLimited():object; 
    public function GetByIdLimited(string $id):object; 
    public function GetByIdAndTypeLimited(string $id , string $transactionTypeId):object; 
    public function GetByDateLimted (string $date):object; 
    public function GetByDateAndTypeLimted (string $date , string $type):object; 
    public function GetByPeriodLimted(string $dateFrom , string $dateTo):object; 
    public function GetByPeriodAndTypeLimted(string $dateFrom , string $dateTo , string $type):object; 
    public function GetTodayBalance():int; 
    public function GetById(string $id):object; 
    public function GetByProjectId(string $id):object; 
    public function GetByBillId(string $id):object;
    public function Update(array $toUpdate , string $id):bool;
    public function DestroyByBillId(string $id):bool;
    public function Destroy(string $id):bool ; 
}