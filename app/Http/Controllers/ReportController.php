<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use App\Repository\Contracts\TransactionRepoContract;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $transactionProvider; 
    private $customerProvider;
    private $productProvider; 
    private $categoryProvider; 
    private $projectProvider; 
    public function __construct(
        TransactionRepoContract $transactionProvider,
        CustomerRepoContract $customerProvider,
        ProductRepoContract $productProvider,
        ProductRepoContract $categoryProvider,
        ProjectRepoContract $projectProvider,
    )
    {
        $this->transactionProvider = $transactionProvider; 
        $this->customerProvider = $customerProvider;
        $this->productProvider = $productProvider; 
        $this->categoryProvider = $categoryProvider;
        $this->projectProvider = $projectProvider;
    } 
    public function ReportPage(){
        //transaction List today
        $todayTransactions =$this->transactionProvider->GetAllForToday(); 

        //today balance
        $todayBalance = $this->transactionProvider->GetTodayBalance(); 
        $todayWithdraw = abs($this->transactionProvider->GetAllTodayWithdrawOnly()->sum('amount')); 
        $todayDeposit = $this->transactionProvider->GetAllTodayDepositeOnly()->sum('amount'); 
        
        //count all customer
        $customersCount= $this->customerProvider->getAll()->count();

        //count all products 
        $productsCount = $this->productProvider->GetAll()->count(); 

        //count all items in products
        $itemsOnProductsCount = $this->productProvider->GetAll()->sum('quantity'); 

        //count all categories
        $categoriesCount = $this->categoryProvider->GetAll()->count() - 1; //subtract 1 cuz 'unclassified is not a real category' 

        //count all projects
        $projectsCount = $this->projectProvider->getAll()->count();

        //count all open projects 
        $projectsOpenCount = $this->projectProvider->GetOpenProjects()->count(); 
        
        
        return view('report.report', [
            'todayTransactions'=>$todayTransactions,
            'todayBalance'=>$todayBalance,
            'todayWithdraw'=>$todayWithdraw,
            'todayDeposit'=>$todayDeposit,
            'customersCount' => $customersCount,
            'productsCount'=> $productsCount,
            'categoriesCount'=>$categoriesCount,
            'itemsOnProductsCount'=>$itemsOnProductsCount,
            'projectsCount'=>$projectsCount,
            'projectsOpenCount'=>$projectsOpenCount,   
        ]); 
    }

}
