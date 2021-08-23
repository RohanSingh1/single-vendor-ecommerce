<?php

namespace App\Providers;

use App\Repositories\MenuRepository;
use App\Repositories\MenuRepositoryInterface;
use App\Repositories\PageRepository;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\SettingsRepository;
use App\Repositories\SettingsRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
    }
}
