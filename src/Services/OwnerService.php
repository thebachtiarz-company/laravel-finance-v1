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

    // ? Public Methods
    /**
     * Create new owner
     *
     * @return array
     */
    public static function create(): array
    {
        return CurlService::setUrl(UrlDomainInterface::URL_OWNER_CREATE_NAME)->post();
    }

    /**
     * Update owner code
     *
     * @return array
     */
    public static function updateCode(): array
    {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data']
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_OWNER_UPDATE_CODE_NAME)->setData($_body)->post();
    }

    /**
     * Update owner status
     *
     * @param string $ownerStatus
     * @return array
     */
    public static function updateStatus(string $ownerStatus): array
    {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_STATUS) => $ownerStatus
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_OWNER_UPDATE_STATUS_NAME)->setData($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
