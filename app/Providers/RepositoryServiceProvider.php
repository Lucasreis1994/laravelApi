<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\ConversionRepositoryInterface;
use App\Repositories\ConversionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ConversionRepositoryInterface::class, ConversionRepository::class);
    }
}
