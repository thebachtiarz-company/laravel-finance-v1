<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;

class FinanceService
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
     * Create new finance account
     *
     * @param string $financeType Default: AA
     * @return array
     */
    public function create(string $financeType = 'AA'): array
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_TYPE) => $financeType
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_FINANCE_CREATE_NAME)->setBody($_body)->post();
    }

    /**
     * Update finance account code
     *
     * @param string $financeAccount
     * @return array
     */
    public function updateCode(string $financeAccount): array
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_FINANCE_UPDATE_ACCOUNT_NAME)->setBody($_body)->post();
    }

    /**
     * Update finance account type
     *
     * @param string $financeAccount
     * @param string $financeType Default: AA
     * @return array
     */
    public function updateType(string $financeAccount, string $financeType = 'AA'): array
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_TYPE) => $financeType
        ];

        return $this->curlService->setUrl(UrlDomainInterface::URL_FINANCE_UPDATE_TYPE_NAME)->setBody($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
