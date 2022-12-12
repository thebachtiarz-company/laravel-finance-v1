<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Traits\Service\OwnerBodyDataTrait;
use TheBachtiarz\Toolkit\Helper\App\Response\DataResponse;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class PurposeService extends CurlService
{
    use OwnerBodyDataTrait, DataResponse;

    // ? Public Methods
    /**
     * Create new finance purpose
     *
     * @param string $purposeInformation
     * @return CurlResolverData
     */
    public function create(string $purposeInformation): CurlResolverData
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver->getStatus())
            return $ownerResolver;

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver->getData(),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_INFORMATION) => $purposeInformation
        ];

        return $this->setUrl(UrlDomainInterface::URL_PURPOSE_CREATE_NAME)->setBody($_body)->post();
    }

    /**
     * Get finance purpose list by owner
     *
     * @param integer|null $perPage Default: 10
     * @param integer|null $currentPage Default: 1
     * @return CurlResolverData
     */
    public function list(?int $perPage = 10, ?int $currentPage = 1): CurlResolverData
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver->getStatus())
            return $ownerResolver;

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver->getData(),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_PERPAGE) => $perPage,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_CURRENTPAGE) => $currentPage
        ];

        return $this->setUrl(UrlDomainInterface::URL_PURPOSE_LIST_NAME)->setBody($_body)->post();
    }

    /**
     * Detail finance purpose
     *
     * @param string $purposeCode
     * @return CurlResolverData
     */
    public function detail(string $purposeCode): CurlResolverData
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver->getStatus())
            return $ownerResolver;

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver->getData(),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode
        ];

        return $this->setUrl(UrlDomainInterface::URL_PURPOSE_DETAIL_NAME)->setBody($_body)->post();
    }

    /**
     * Update finance purpose information
     *
     * @param string $purposeCode
     * @param string $purposeInformation
     * @return CurlResolverData
     */
    public function update(string $purposeCode, string $purposeInformation): CurlResolverData
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver->getStatus())
            return $ownerResolver;

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver->getData(),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_INFORMATION) => $purposeInformation
        ];

        return $this->setUrl(UrlDomainInterface::URL_PURPOSE_UPDATE_NAME)->setBody($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
