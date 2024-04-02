<?php

namespace Brucelwayne\Searchable;

use Brucelwayne\Searchable\Models\BigSearchableModel;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class SearchableServiceProvider extends ServiceProvider
{
    protected $module_name = 'searchable';

    function boot()
    {
        Relation::morphMap([
            'big_searchable' => BigSearchableModel::class,
        ]);

        $this->bootConfigs();
        $this->bootMigrations();
    }

    protected function bootConfigs(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/searchable.php', $this->module_name
        );
    }

    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {

    }
}