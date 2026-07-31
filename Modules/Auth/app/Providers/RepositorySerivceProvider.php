<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Auth\Repositories\Contracts\AuthInterface;
use Modules\Auth\Repositories\AuthRepository;

class RepositorySerivceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void {
        
        $this->app->bind(AuthInterface::class, AuthRepository::class);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
