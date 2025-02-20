<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BlockRepositoryInterface;
use App\Repositories\BlockRepository;
use App\Repositories\DomainRepository;
use App\Repositories\DomainRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlockRepositoryInterface::class, BlockRepository::class);
        $this->app->bind(DomainRepositoryInterface::class, DomainRepository::class);
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
