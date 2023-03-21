<?php 
namespace App\Repository\Contracts;
use App\Models\BillModel;

interface BillRepoContract {

    public function Store(array $data):BillModel;
    public function GetFullBillById(string $id):object; 
    public function GetTotalInvoiceById(string $id):string; 
}