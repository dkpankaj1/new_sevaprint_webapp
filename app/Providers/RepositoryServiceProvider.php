<?php

namespace App\Providers;

use App\Repositories\Contracts\BalanceTransferRepositoryInterface;
use App\Repositories\Contracts\FeatureRepositoryInterface;
use App\Repositories\Contracts\MobileRechargeRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\UserServiceRepositoryInterface;
use App\Repositories\Eloquent\BalanceTransferRepository;
use App\Repositories\Eloquent\FeatureRepository;
use App\Repositories\Eloquent\MobileRechargeRepository;
use App\Repositories\Eloquent\TransactionRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\UserServiceRepository;
use App\Services\BalanceTransferService;
use App\Services\Contracts\BalanceTransferServiceInterface;
use App\Services\Contracts\FeatureServiceInterface;
use App\Services\Contracts\MobileRechargeServiceInterface;
use App\Services\FeatureService;
use App\Services\MobileRechargeService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    public function registerRepositories()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BalanceTransferRepositoryInterface::class, BalanceTransferRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(MobileRechargeRepositoryInterface::class, MobileRechargeRepository::class);
        $this->app->bind(UserServiceRepositoryInterface::class, UserServiceRepository::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
    }
    public function registerServices()
    {
        $this->app->bind(BalanceTransferServiceInterface::class, BalanceTransferService::class);
        $this->app->bind(MobileRechargeServiceInterface::class, MobileRechargeService::class);
        $this->app->bind(FeatureServiceInterface::class, FeatureService::class);
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
