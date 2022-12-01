<?php

namespace TheBachtiarz\Finance\Interfaces\Config;

interface FinanceConfigInterface
{
    public const FINANCE_CONFIG_NAME = 'thebachtiarz_finance';

    public const FINANCE_CONFIG_PREFIX_NAME = 'finance';

    public const FINANCE_ATTRIBUTES_CONFIG_SYSTEM_NAME = 'finance_attributes_config_system';

    public const ATTRIBUTE_OWNER_CODE = 'owner_code';
    public const ATTRIBUTE_OWNER_STATUS = 'owner_status';
    public const ATTRIBUTE_FINANCE_ACCOUNT = 'finance_account';
    public const ATTRIBUTE_PURPOSE_CODE = 'purpose_code';
    public const ATTRIBUTE_BALANCE_TYPE = 'balance_type';
    public const ATTRIBUTE_BALANCE_NOMINAL = 'balance_nominal';
    public const ATTRIBUTE_BALANCE_INFORMATION = 'balance_information';
    public const ATTRIBUTE_DATE_RANGE = 'date_range';
    public const ATTRIBUTE_TYPE_OPTIONS = 'balance_type_options';
    public const ATTRIBUTE_TYPE_CREDIT_CODE = 'balance_type_credit_code';
    public const ATTRIBUTE_TYPE_DEBIT_CODE = 'balance_type_debit_code';
    public const ATTRIBUTE_NOMINAL_CREDIT_RULE = 'balance_nominal_credit_rule';
    public const ATTRIBUTE_NOMINAL_DEBIT_RULE = 'balance_nominal_debit_rule';
}
