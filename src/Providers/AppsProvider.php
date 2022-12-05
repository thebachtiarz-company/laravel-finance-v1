<?php

namespace TheBachtiarz\Finance\Providers;

use TheBachtiarz\Finance\Console\Commands\ConfigSystemSyncronizeCommand;
use TheBachtiarz\Finance\Console\Commands\OwnerCreateCommand;

class AppsProvider
{
    //

    public const COMMANDS = [
        OwnerCreateCommand::class,
        ConfigSystemSyncronizeCommand::class
    ];

    /**
     * Register config
     *
     * @return boolean
     */
    public function registerConfig(): bool
    {
        try {
            foreach (DataProvider::registerConfig() as $key => $register) {
                config($register);
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Register commands
     *
     * @return array
     */
    public function registerCommands(): array
    {
        try {
            return self::COMMANDS;
        } catch (\Throwable $th) {
            return [];
        }
    }
}
