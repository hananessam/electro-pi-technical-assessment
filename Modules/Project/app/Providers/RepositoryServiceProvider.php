<?php

namespace Modules\Project\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Project\Repositories\Contracts\ProjectInterface;
use Modules\Project\Repositories\ProjectRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(ProjectInterface::class, ProjectRepository::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
