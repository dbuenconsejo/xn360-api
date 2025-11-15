<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind repository interface to the concrete implementation
        $this->app->bind(
            \App\Repositories\DispatchQueueItemRepositoryInterface::class,
            \App\Repositories\DispatchQueueItemRepository::class
        );

        // Bind service interface to concrete service
        $this->app->bind(
            \App\Services\DispatchQueueItemServiceInterface::class,
            \App\Services\DispatchQueueItemService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
