<?php

namespace TheBachtiarz\Finance\Helpers;

use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Services\ConfigService;
use TheBachtiarz\Toolkit\Cache\Service\Cache;

class ConfigSystemHelper
{
    //

    /**
     * Config Service
     *
     * @var ConfigService
     */
    protected ConfigService $configService;

    /**
     * Config system
     *
     * @var array
     */
    private static array $configSystem = [];

    /**
     * Constructor
     *
     * @param ConfigService $configService
     */
    public function __construct(
        ConfigService $configService
    ) {
        $this->configService = $configService;
    }

    // ? Public Methods
    /**
     * Sync config system
     *
     * @return array
     */
    public function syncConfigAttributesFromServer(): array
    {
        $_configSystem = $this->configService->getConfig();

        throw_if(!$_configSystem->getStatus(), 'Exception', $_configSystem->getMessage());

        Cache::set(FinanceConfigInterface::FINANCE_ATTRIBUTES_CONFIG_SYSTEM_NAME, $_configSystem->getData());

        return $_configSystem->getData();
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
            if (!static::$configSystem) {
                static::$configSystem = Cache::get(FinanceConfigInterface::FINANCE_ATTRIBUTES_CONFIG_SYSTEM_NAME);
            }

            return static::$configSystem[$configName];
        } catch (\Throwable $th) {
            return null;
        }
    }

    // ? Private Methods

    // ? Setter Modules
}
