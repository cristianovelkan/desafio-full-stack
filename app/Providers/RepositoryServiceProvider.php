<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    BalanceRepositoryInterface,
    UserRepositoryInterface,
};
use App\Repositories\{
    BalanceRepository,
    UserRepository,
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BalanceRepositoryInterface::class, BalanceRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
