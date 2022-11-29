<?php

namespace TheBachtiarz\Finance\Providers;

class AppsProvider
{
    //

    public const COMMANDS = [
        // 
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
