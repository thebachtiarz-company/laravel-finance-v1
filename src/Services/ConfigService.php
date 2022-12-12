<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class ConfigService extends CurlService
{
    //

    // ? Public Methods
    /**
     * Get config system
     *
     * @return CurlResolverData
     */
    public function getConfig(): CurlResolverData
    {
        return $this->setUrl(UrlDomainInterface::URL_CONFIG_SYSTEM_ATTRIBUTES_NAME)->get();
    }

    // ? Private Methods

    // ? Setter Modules
}
