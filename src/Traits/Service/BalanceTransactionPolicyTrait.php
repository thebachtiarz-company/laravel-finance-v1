<?php

namespace TheBachtiarz\Finance\Traits\Service;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

/**
 * Balance Transaction Policy Trait
 */
trait BalanceTransactionPolicyTrait
{
    //

    // ? Public Methods

    // ? Private Methods
    /**
     * Transaction type policy
     *
     * @param string $transactionType
     * @return CurlResolverData
     */
    private static function transactionTypePolicy(string $transactionType): CurlResolverData
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            $_transactionTypes = ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_TYPE_OPTIONS);

            throw_if(!in_array($transactionType, array_keys($_transactionTypes)), 'Exception', "Transaction type '$transactionType' is not allowed");

            $result['status'] = true;
            $result['data'] = $_transactionTypes[$transactionType];
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
        } finally {
            return new CurlResolverData($result);
        }
    }

    /**
     * Transaction nominal policy
     *
     * @param string $transactionType
     * @param string $transactionNominal
     * @return CurlResolverData
     */
    private static function transactionNominalPolicy(string $transactionType, string $transactionNominal): CurlResolverData
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            switch ($transactionType) {
                case ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_TYPE_CREDIT_CODE):
                    /**
                     * Rule: cannot make a credit less than current rule
                     */
                    throw_if(
                        (int)$transactionNominal < (int)ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_CREDIT_RULE)['min'],
                        'Exception',
                        "Amount of credit nominal cannot less than " . ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_CREDIT_RULE)['min']
                    );

                    /**
                     * Rule: cannot make a credit more than current rule
                     */
                    throw_if(
                        (int)$transactionNominal > (int)ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_CREDIT_RULE)['max'],
                        'Exception',
                        "Amount of credit nominal cannot more than " . ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_CREDIT_RULE)['max']
                    );

                    break;

                case ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_TYPE_DEBIT_CODE):
                    /**
                     * Rule: cannot make a debit less than current rule
                     */
                    throw_if(
                        (int)$transactionNominal < (int)ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_DEBIT_RULE)['min'],
                        'Exception',
                        "Amount of debit nominal cannot less than " . ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_DEBIT_RULE)['min']
                    );

                    /**
                     * Rule: cannot make a debit more than current rule
                     */
                    throw_if(
                        (int)$transactionNominal > (int)ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_DEBIT_RULE)['max'],
                        'Exception',
                        "Amount of debit nominal cannot more than " . ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_BALANCE_NOMINAL_DEBIT_RULE)['max']
                    );

                    break;

                default:
                    throw new \Exception("Transaction type not found");
                    break;
            }

            $result['status'] = true;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
        } finally {
            return new CurlResolverData($result);
        }
    }

    // ? Setter Modules
}
