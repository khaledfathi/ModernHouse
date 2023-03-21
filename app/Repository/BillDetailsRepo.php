<?php 
namespace App\Repository;
use App\Models\BillDetailsModel;
use App\Models\BillModel;
use App\Repository\Contracts\BillDetailsRepoContract; 

class BillDetailsRepo implements BillDetailsRepoContract{

    public function Store(array $data):BillDetailsModel
    {
        return BillDetailsModel::create($data); 
    }    
}