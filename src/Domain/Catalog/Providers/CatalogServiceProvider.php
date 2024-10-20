<?php

namespace Domain\Catalog\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
class CatalogServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }

    public function register(): void
    {
        $this->app->register(ActionsServiceProvider::class);
    }
}
