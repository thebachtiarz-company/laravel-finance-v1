<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Services\CurlService;
use TheBachtiarz\Finance\Traits\Service\BalanceTransactionPolicyTrait;
use TheBachtiarz\Finance\Traits\Service\OwnerBodyDataTrait;
use TheBachtiarz\Toolkit\Helper\App\Carbon\CarbonHelper;
use TheBachtiarz\Toolkit\Helper\App\Response\DataResponse;

class BalanceService
{
    use OwnerBodyDataTrait, BalanceTransactionPolicyTrait, CarbonHelper, DataResponse;

    // ? Public Methods
    /**
     * Create new transaction
     *
     * @param string $financeAccount
     * @param string $purposeCode
     * @param string $balanceType
     * @param string $balanceNominal
     * @param string $balanceInformation
     * @return array
     */
    public static function create(
        string $financeAccount,
        string $purposeCode,
        string $balanceType,
        string $balanceNominal,
        string $balanceInformation
    ): array {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $transactionTypePolicy = self::transactionTypePolicy($balanceType);
        if (!$transactionTypePolicy['status'])
            return self::errorResponse($transactionTypePolicy['message']);

        $transactionNominalPolicy = self::transactionNominalPolicy($balanceType, $balanceNominal);
        if (!$transactionNominalPolicy['status'])
            return self::errorResponse($transactionNominalPolicy['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_TYPE) => $balanceType,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL) => $balanceNominal,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_INFORMATION) => $balanceInformation
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_BALANCE_CREATE_NAME)->setData($_body)->post();
    }

    /**
     * Get list of finance transaction histories by purpose
     *
     * @param string $financeAccount
     * @param string $purposeCode
     * @param string|null $dateFrom Default: Current date format Y-m-d
     * @param string|null $dateTo Default: Current date format Y-m-d
     * @param integer|null $perPage Default: 10
     * @param integer|null $currentPage Default: 1
     * @return array
     */
    public static function transactionHistories(
        string $financeAccount,
        string $purposeCode,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $perPage = 10,
        ?int $currentPage = 1
    ): array {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_DATE_FROM) => $dateFrom ?: self::dbDateTime(split: 'date'),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_DATE_TO) => $dateTo ?: self::dbDateTime(split: 'date'),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_PERPAGE) => $perPage,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_CURRENTPAGE) => $currentPage
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_BALANCE_HISTORY_NAME)->setData($_body)->post();
    }

    /**
     * Get detail transaction
     *
     * @param string $transactionReference
     * @return array
     */
    public static function transactionDetail(string $transactionReference): array
    {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_REFERENCE) => $transactionReference
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_BALANCE_DETAIL_NAME)->setData($_body)->post();
    }

    /**
     * Get list finance account latest transaction in specific finance purpose
     *
     * @param string $ownerCode
     * @param string $purposeCode
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param integer|null $perPage
     * @param integer|null $currentPage
     * @return array
     */
    public static function financesInPurpose(
        string $ownerCode,
        string $purposeCode,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $perPage = 10,
        ?int $currentPage = 1
    ): array {
        $ownerResolver = self::ownerBodyDataResolver();
        if (!$ownerResolver['status'])
            return self::errorResponse($ownerResolver['message']);

        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE) => $ownerResolver['data'],
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE) => $purposeCode,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_DATE_FROM) => $dateFrom ?: self::dbDateTime(split: 'date'),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_DATE_TO) => $dateTo ?: self::dbDateTime(split: 'date'),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_PERPAGE) => $perPage,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_CURRENTPAGE) => $currentPage
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_BALANCE_FINANCESINPURPOSE_NAME)->setData($_body)->post();
    }

    /**
     * Get list finance purpose latest in specific finance account
     *
     * @param string $financeAccount
     * @param string|null $dateFrom
     * @param string|null $dateTo
     * @param integer|null $perPage
     * @param integer|null $currentPage
     * @return array
     */
    public static function purposesInFinance(
        string $financeAccount,
        ?string $dateFrom = null,
        ?string $dateTo = null,
        ?int $perPage = 10,
        ?int $currentPage = 1
    ): array {
        $_body = [
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT) => $financeAccount,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_DATE_FROM) => $dateFrom ?: self::dbDateTime(split: 'date'),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_DATE_TO) => $dateTo ?: self::dbDateTime(split: 'date'),
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_PERPAGE) => $perPage,
            ConfigSystemHelper::getConfig(FinanceConfigInterface::PAGINATE_CURRENTPAGE) => $currentPage
        ];

        return CurlService::setUrl(UrlDomainInterface::URL_BALANCE_PURPOSESINFINANCE_NAME)->setData($_body)->post();
    }

    // ? Private Methods

    // ? Setter Modules
}
