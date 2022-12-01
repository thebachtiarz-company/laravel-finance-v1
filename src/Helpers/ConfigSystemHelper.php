<?php

namespace TheBachtiarz\Finance\Helpers;

use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Services\ConfigService;
use TheBachtiarz\Toolkit\Cache\Service\Cache;

class ConfigSystemHelper
{
    //

    // ? Public Methods
    /**
     * Sync config system
     *
     * @return array
     */
    public static function syncConfigAttributesFromServer(): array
    {
        $_configSystem = ConfigService::getConfig();

        throw_if(!$_configSystem['status'], 'Exception', $_configSystem['message']);

        Cache::set(FinanceConfigInterface::FINANCE_ATTRIBUTES_CONFIG_SYSTEM_NAME, $_configSystem['data']);

        return $_configSystem['data'];
    }

    /**
     * Get config data
     *
     * @param string $configName
     * @return mixed
     */
    public static function getConfig(string $configName): mixed
    {
        try {
            $_cacheConfig = Cache::get(FinanceConfigInterface::FINANCE_ATTRIBUTES_CONFIG_SYSTEM_NAME);

            return $_cacheConfig[$configName];
        } catch (\Throwable $th) {
            return null;
        }
    }

    // ? Private Methods

    // ? Setter Modules
}
