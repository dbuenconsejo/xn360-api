<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\DispatchQueueItemRepository;
use App\Repositories\DispatchQueueItemRepositoryInterface;
use App\Services\DispatchQueueItemService;
use App\Services\DispatchQueueItemServiceInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            DispatchQueueItemRepositoryInterface::class,
            DispatchQueueItemRepository::class
        );

        $this->app->bind(
            DispatchQueueItemServiceInterface::class,
            DispatchQueueItemService::class
        );
    }
}
