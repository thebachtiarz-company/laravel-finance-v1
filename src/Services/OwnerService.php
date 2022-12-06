<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Traits\Service\OwnerBodyDataTrait;
use TheBachtiarz\Toolkit\Helper\App\Response\DataResponse;

class OwnerService
{
    use OwnerBodyDataTrait, DataResponse;

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
     * Create new owner
     *
     * @return array
     */
    public function create(): array
    {
        return $this->curlService->setUrl(UrlDomainInterface::URL_OWNER_CREATE_NAME)->post();
    }

    /**
     * Update owner code
     *
     * @return array
     */
    public function updateCode(): array
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data']
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_OWNER_UPDATE_CODE_NAME)->setBody($_body)->post();
    }

    /**
     * Update owner status
     *
     * @param string $ownerStatus
     * @return array
     */
    public function updateStatus(string $ownerStatus): array
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_STATUS) => $ownerStatus
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_OWNER_UPDATE_STATUS_NAME)->setBody($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
