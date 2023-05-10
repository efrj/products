<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Repositories\CategoryRepository;
use App\Contracts\ProductContract;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryContract::class, CategoryRepository::class);
        $this->app->bind(ProductContract::class, ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
