<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Traits\Service\OwnerBodyDataTrait;
use TheBachtiarz\Toolkit\Helper\App\Response\DataResponse;

class PurposeService
{
    use OwnerBodyDataTrait, DataResponse;

    // ? Public Methods
    /**
     * Create new finance purpose
     *
     * @param string $purposeInformation
     * @return array
     */
    public static function create(string $purposeInformation): array
    {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_INFORMATION) => $purposeInformation
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_PURPOSE_CREATE_NAME)->setData($_body)->post();
    }

    /**
     * Get finance purpose list by owner
     *
     * @param integer|null $perPage Default: 10
     * @param integer|null $currentPage Default: 1
     * @return array
     */
    public static function list(?int $perPage = 10, ?int $currentPage = 1): array
    {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_PERPAGE) => $perPage,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_CURRENTPAGE) => $currentPage
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_PURPOSE_LIST_NAME)->setData($_body)->post();
    }

    /**
     * Detail finance purpose
     *
     * @param string $purposeCode
     * @return array
     */
    public static function detail(string $purposeCode): array
    {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_PURPOSE_DETAIL_NAME)->setData($_body)->post();
    }

    /**
     * Update finance purpose information
     *
     * @param string $purposeCode
     * @param string $purposeInformation
     * @return array
     */
    public function update(string $purposeCode, string $purposeInformation): array
    {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_INFORMATION) => $purposeInformation
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_PURPOSE_UPDATE_NAME)->setData($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
