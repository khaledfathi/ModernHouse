<?php 
namespace App\Repository; 
use App\Models\BillModel;
use App\Repository\Contracts\BillRepoContract; 

class BillRepo implements BillRepoContract{

    public function Store(array $data):BillModel
    {
        return BillModel::create($data); 
    }
    public function GetFullBillById(string $id):object
    {
        return BillModel::leftJoin('bill_details' , 'bills.id' , '=' , 'bill_details.bill_id')->where('bills.id' , $id)
        ->select(
            'bills.id' ,
            'bills.customer_name',
            'bills.customer_phone', 
            'bills.date',
            'bills.time',
            'bills.status',
            'bills.customer_id',
            'bill_details.product_name',
            'bill_details.price',
            'bill_details.quantity',
            'bill_details.total',
            'bill_details.product_id',
            )->get(); 
    }
    public function GetTotalInvoiceById(string $id):string
    {
        return BillModel::leftJoin('bill_details' , 'bills.id' , '=' , 'bill_details.bill_id')->where('bills.id' , $id)->sum('total'); 
    }
}