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
     * Create new finance purpose
     *
     * @param string $purposeInformation
     * @return array
     */
    public function create(string $purposeInformation): array
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_INFORMATION) => $purposeInformation
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_PURPOSE_CREATE_NAME)->setBody($_body)->post();
    }

    /**
     * Get finance purpose list by owner
     *
     * @param integer|null $perPage Default: 10
     * @param integer|null $currentPage Default: 1
     * @return array
     */
    public function list(?int $perPage = 10, ?int $currentPage = 1): array
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_PERPAGE) => $perPage,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_CURRENTPAGE) => $currentPage
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_PURPOSE_LIST_NAME)->setBody($_body)->post();
    }

    /**
     * Detail finance purpose
     *
     * @param string $purposeCode
     * @return array
     */
    public function detail(string $purposeCode): array
    {
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_PURPOSE_DETAIL_NAME)->setBody($_body)->post();
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
        $ownerResolver = $this->ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_INFORMATION) => $purposeInformation
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_PURPOSE_UPDATE_NAME)->setBody($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
