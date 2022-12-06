<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;

class ConfigService
{
    //

    /**
     * Curl Service
     *
     * @var CurlService
     */
    protected CurlService $curlService;

    /**
     * Constructor
     *
     * @param CurlService $curlService
     */
    public function __construct(
        CurlService $curlService
    ) {
        $this->curlService = $curlService;
    }

    // ? Public Methods
    /**
     * Get config system
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->curlService->setUrl(UrlDomainInterface::URL_CONFIG_SYSTEM_ATTRIBUTES_NAME)->get();
    }

    // ? Private Methods

    // ? Setter Modules
}
