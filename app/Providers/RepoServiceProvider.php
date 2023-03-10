<?php

namespace App\Providers;

use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\Contracts\ProjectRepoContract;
use App\Repository\Contracts\TransactionRepoContract;
use App\Repository\CustomerRepo;
use App\Repository\ProjectRepo;
use App\Repository\TransactionRepo;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
