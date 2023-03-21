<?php 
namespace App\Repository\Contracts;
use App\Models\BillDetailsModel; 

interface BillDetailsRepoContract {
    public function Store(array $data):BillDetailsModel; 
}