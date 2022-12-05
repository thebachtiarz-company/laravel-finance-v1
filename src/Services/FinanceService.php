<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;

class FinanceService
{
    //

    // ? Public Methods
    /**
     * Create new finance account
     *
     * @param string $financeType Default: AA
     * @return array
     */
    public static function create(string $financeType = 'AA'): array
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_TYPE) => $financeType
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_FINANCE_CREATE_NAME)->setData($_body)->post();
    }

    /**
     * Update finance account code
     *
     * @param string $financeAccount
     * @return array
     */
    public static function updateCode(string $financeAccount): array
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_FINANCE_UPDATE_ACCOUNT_NAME)->setData($_body)->post();
    }

    /**
     * Update finance account type
     *
     * @param string $financeAccount
     * @param string $financeType Default: AA
     * @return array
     */
    public static function updateType(string $financeAccount, string $financeType = 'AA'): array
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_TYPE) => $financeType
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_FINANCE_UPDATE_TYPE_NAME)->setData($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
