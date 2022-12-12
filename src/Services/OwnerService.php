<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Traits\Service\OwnerBodyDataTrait;
use TheBachtiarz\Toolkit\Helper\App\Response\DataResponse;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class OwnerService extends CurlService
{
    use OwnerBodyDataTrait, DataResponse;

    // ? Public Methods
    /**
     * Create new owner
     *
     * @return CurlResolverData
     */
    public function create(): CurlResolverData
    {
        return $this->setUrl(UrlDomainInterface::URL_OWNER_CREATE_NAME)->post();
    }

    /**
     * Update owner code
     *
     * @return CurlResolverData
     */
    public function updateCode(): CurlResolverData
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver->getStatus())
            return $ownerResolver;

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver->getData()
        ];

        return $this->setUrl(UrlDomainInterface::URL_OWNER_UPDATE_CODE_NAME)->setBody($_body)->post();
    }

    /**
     * Update owner status
     *
     * @param string $ownerStatus
     * @return CurlResolverData
     */
    public function updateStatus(string $ownerStatus): CurlResolverData
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver->getStatus())
            return $ownerResolver;

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver->getData(),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_STATUS) => $ownerStatus
        ];

        return $this->setUrl(UrlDomainInterface::URL_OWNER_UPDATE_STATUS_NAME)->setBody($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
