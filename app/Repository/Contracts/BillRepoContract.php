<?php 
namespace App\Repository\Contracts;
use App\Models\BillModel;

interface BillRepoContract {

    public function Store(array $data):BillModel;
    public function GetById(string $id):object; 
    public function GetByCustomerPhone(string $phone):object; 
    public function GetByCustomerName(string $name):object; 
    public function GetFullBillById(string $id):object; 
    public function GetTotalInvoiceById(string $id):string; 
    public function Destroy(string $id):bool; 
}