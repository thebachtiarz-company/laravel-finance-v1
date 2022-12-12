<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class FinanceService extends CurlService
{
    //

    // ? Public Methods
    /**
     * Create new finance account
     *
     * @param string $financeType Default: AA
     * @return CurlResolverData
     */
    public function create(string $financeType = 'AA'): CurlResolverData
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_TYPE) => $financeType
        ];

        return $this->setUrl(UrlDomainInterface::URL_FINANCE_CREATE_NAME)->setBody($_body)->post();
    }

    /**
     * Update finance account code
     *
     * @param string $financeAccount
     * @return CurlResolverData
     */
    public function updateCode(string $financeAccount): CurlResolverData
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount
        ];

        return $this->setUrl(UrlDomainInterface::URL_FINANCE_UPDATE_ACCOUNT_NAME)->setBody($_body)->post();
    }

    /**
     * Update finance account type
     *
     * @param string $financeAccount
     * @param string $financeType Default: AA
     * @return CurlResolverData
     */
    public function updateType(string $financeAccount, string $financeType = 'AA'): CurlResolverData
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_TYPE) => $financeType
        ];

        return $this->setUrl(UrlDomainInterface::URL_FINANCE_UPDATE_TYPE_NAME)->setBody($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
