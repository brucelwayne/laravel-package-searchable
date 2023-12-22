<?php

namespace Brucelwayne\Searchable;

use Illuminate\Support\ServiceProvider;

class SearchableServiceProvider extends ServiceProvider
{
    protected $module_name = 'searchable';

    public function register()
    {

    }

    function boot()
    {
        $this->bootConfigs();
        $this->bootMigrations();
    }

    protected function bootConfigs(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/searchable.php', $this->module_name
        );
    }

    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}