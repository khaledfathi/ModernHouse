<?php

namespace App\Providers;

use App\Repository\BillRepo;
use App\Repository\CategoryRepo;
use App\Repository\Contracts\BillRepoContract;
use App\Repository\Contracts\CategoryRepoContract;
use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProductRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use App\Repository\Contracts\TransactionRepoContract;
use App\Repository\Contracts\TransactionTypeRepoContract;
use App\Repository\CustomerRepo;
use App\Repository\ProductRepo;
use App\Repository\ProjectRepo;
use App\Repository\TransactionRepo;
use App\Repository\TransactionTypeRepo;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepoContract::class , CustomerRepo::class); 
        $this->app->bind(ProjectRepoContract::class , ProjectRepo::class); 
        $this->app->bind(TransactionRepoContract::class , TransactionRepo::class); 
        $this->app->bind(ProductRepoContract::class , ProductRepo::class); 
        $this->app->bind(CategoryRepoContract::class , CategoryRepo::class); 
        $this->app->bind(TransactionTypeRepoContract::class , TransactionTypeRepo::class); 
        $this->app->bind(BillRepoContract::class , BillRepo::class); 
        $this->app->bind(BillDetailsRepoContract::class , BillDetailsRepoContract::class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
