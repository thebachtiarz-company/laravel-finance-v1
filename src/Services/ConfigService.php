<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;

class ConfigService
{
    //

    // ? Public Methods
    /**
     * Get config system
     *
     * @return array
     */
    public static function getConfig(): array
    {
        return CurlService::setUrl(UrlDomainInterface::URL_CONFIG_SYSTEM_ATTRIBUTES_NAME)->get();
    }

    // ? Private Methods

    // ? Setter Modules
}
