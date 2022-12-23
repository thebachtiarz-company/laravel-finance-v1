<?php

namespace TheBachtiarz\Finance;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Providers\AppsProvider;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        /**
         * @var AppsProvider $appsProvider
         */
        $appsProvider = new AppsProvider;

        $appsProvider->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($appsProvider->registerCommands());
        }
    }

    /**
     * {@inheritDoc}
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . FinanceConfigInterface::FINANCE_CONFIG_NAME . '.php' => config_path(FinanceConfigInterface::FINANCE_CONFIG_NAME . '.php'),
            ], 'thebachtiarz-finance-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-finance-migrations');
        }
    }
}
