<?php

namespace App\Providers;

use App\Repository\Contracts\CustomerRepoContract;
use App\Repository\CustomerRepo;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerRepoContract::class , CustomerRepo::class); 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
