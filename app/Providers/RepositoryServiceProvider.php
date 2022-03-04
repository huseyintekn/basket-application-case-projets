<?php

namespace App\Providers;

use App\Repository\App\Basket\BasketInterfaceRepository;
use App\Repository\App\Basket\BasketRepository;
use App\Repository\App\Costomer\CostemerInterfaceRepository;
use App\Repository\App\Costomer\CostemerRepository;
use App\Repository\App\Order\OrderInterfaceRepository;
use App\Repository\App\Order\OrderRepository;
use App\Repository\App\Product\ProductInterfaceRepository;
use App\Repository\App\Product\ProductRepository;
use App\Repository\BaseInterfaceRepository;
use App\Repository\BaseRepository;
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
        $this->app->bind(BaseInterfaceRepository::class, BaseRepository::class);
        $this->app->bind(ProductInterfaceRepository::class, ProductRepository::class);
        $this->app->bind(CostemerInterfaceRepository::class, CostemerRepository::class);
        $this->app->bind(BasketInterfaceRepository::class, BasketRepository::class);
        $this->app->bind(OrderInterfaceRepository::class, OrderRepository::class);
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
