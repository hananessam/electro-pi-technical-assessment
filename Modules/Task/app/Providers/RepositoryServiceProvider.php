<?php

namespace Modules\Task\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Task\Repositories\Contracts\TaskInterface;
use Modules\Task\Repositories\TaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(TaskInterface::class, TaskRepository::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
