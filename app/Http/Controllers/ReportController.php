<?php

namespace App\Http\Controllers;

use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use App\Repository\Contracts\TransactionRepoContract;
use Carbon\Carbon;
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
        
        //balance for this month 
        $thisMonthBalance = $this->transactionProvider->GetThisMonthBalance();
        $thisMonthWithdraw = abs($this->transactionProvider->GetThisMonthWithdraw()); 
        $thisMonthDeposit = $this->transactionProvider->GetThisMontDeposit(); 
        $currentMonth = config('constants.monthsNames')[(int)Carbon::now()->timezone('Africa/Cairo')->format('m')-1];
        $currentYear = Carbon::now()->timezone('Africa/Cairo')->year;
        $currentMonthYear = $currentMonth.' '.$currentYear ;
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
        $projectsOpen= $this->projectProvider->GetOpenProjects();

        //count all Ended projects with Indebtedness 
        $projectEndedWithIndebtednessCount = $this->projectProvider->GetEndedProjectWithIndebtedness()->count();  
        $projectEndedWithIndebtedness = $this->projectProvider->GetEndedProjectWithIndebtedness();  
        
        //count all ended project not dileverd 
        $projectsEndedNotDileveredCount = $this->projectProvider->GetEndedProjectNotDelivered()->count(); 
        $projectsEndedNotDilevered = $this->projectProvider->GetEndedProjectNotDelivered(); 

        //count all projects are delayed 
        $projectsDelayedCount = $this->projectProvider->GetProjectDelayed()->count(); 
        $projectsDelayed = $this->projectProvider->GetProjectDelayed(); 


        return view('report.report', [
            'todayTransactions'=>$todayTransactions,
            'todayBalance'=>$todayBalance,
            'todayWithdraw'=>$todayWithdraw,
            'thisMonthBalance'=>$thisMonthBalance,
            'thisMonthWithdraw'=>$thisMonthWithdraw,
            'thisMonthDeposit'=>$thisMonthDeposit,
            'currentMonthYear'=>$currentMonthYear,
            'todayDeposit'=>$todayDeposit,
            'customersCount' => $customersCount,
            'productsCount'=> $productsCount,
            'categoriesCount'=>$categoriesCount,
            'itemsOnProductsCount'=>$itemsOnProductsCount,
            'projectsCount'=>$projectsCount,
            'projectsOpenCount'=>$projectsOpenCount,
            'projectsOpen'=>$projectsOpen,
            'projectEndedWithIndebtednessCount'=> $projectEndedWithIndebtednessCount,
            'projectEndedWithIndebtedness'=> $projectEndedWithIndebtedness,
            'projectsEndedNotDeliveredCount'=> $projectsEndedNotDileveredCount,
            'projectsEndedNotDelivered'=> $projectsEndedNotDilevered,
            'projectsDelayedCount'=>$projectsDelayedCount,
            'projectsDelayed'=>$projectsDelayed,
        ]); 
    }

}
