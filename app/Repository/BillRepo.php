<?php 
namespace App\Repository; 
use App\Models\BillModel;
use App\Repository\Contracts\BillRepoContract; 

class BillRepo implements BillRepoContract{

    public function Store(array $data):BillModel
    {
        return BillModel::create($data); 
    }
    public function GetById(string $id):object
    {
        return BillModel::where('id' , $id)->get(); 
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
    public function GetByCustomerPhone(string $phone):object
    {
        return BillModel::where('customer_phone' , $phone)->orderBy('date','desc')->orderBy('time','desc')->get(); 
    }
    public function GetByCustomerName(string $name):object
    {
        return BillModel::where('customer_name' ,'like', '%'.$name.'%')->orderBy('date','desc')->orderBy('time','desc')->get(); 
    }
    public function GetTotalInvoiceById(string $id):string
    {
        return BillModel::leftJoin('bill_details' , 'bills.id' , '=' , 'bill_details.bill_id')->where('bills.id' , $id)->sum('total'); 
    }
    public function Destroy(string $id):bool
    {
        $found = BillModel::find($id); 
        if ($found){
            $found->delete(); 
            return true ; 
        }
        return false ; 
    }
}