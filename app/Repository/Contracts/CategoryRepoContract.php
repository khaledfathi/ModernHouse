<?php 

namespace App\Repository\Contracts;
use App\Models\CategoryModel;
use Illuminate\Http\Request; 


interface CategoryRepoContract {
    public function GetAll(); 
    public function GetById(string $id):object; 
    public function Store(Request $request):CategoryModel; 
    public function Destroy (string $id):bool; 
    public function Update(array $data , string $id):bool ; 

}
