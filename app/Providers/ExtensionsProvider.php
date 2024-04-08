<?php

namespace App\Providers;

use App\Services\BookService;
use App\Services\BookStoreService;
use App\Services\IBookService;
use App\Services\IBookStoreService;
use App\Services\IStoreService;
use App\Services\StoreService;
use Illuminate\Support\ServiceProvider;

class ExtensionsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IBookService::class, BookService::class);
        $this->app->bind(IStoreService::class, StoreService::class);
        $this->app->bind(IBookStoreService::class, BookStoreService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
