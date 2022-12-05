<?php

namespace TheBachtiarz\Finance\Interfaces\Config;

interface UrlDomainInterface
{
    public const URL_AVAILABLE_OPTIONS = [
        self::URL_CONFIG_SYSTEM_ATTRIBUTES_NAME => self::URL_CONFIG_SYSTEM_ATTRIBUTES_PATH,
        self::URL_OWNER_CREATE_NAME => self::URL_OWNER_CREATE_PATH,
        self::URL_OWNER_UPDATE_CODE_NAME => self::URL_OWNER_UPDATE_CODE_PATH,
        self::URL_OWNER_UPDATE_STATUS_NAME => self::URL_OWNER_UPDATE_STATUS_PATH,
        self::URL_FINANCE_CREATE_NAME => self::URL_FINANCE_CREATE_PATH,
        self::URL_FINANCE_UPDATE_ACCOUNT_NAME => self::URL_FINANCE_UPDATE_ACCOUNT_PATH,
        self::URL_FINANCE_UPDATE_TYPE_NAME => self::URL_FINANCE_UPDATE_TYPE_PATH,
        self::URL_PURPOSE_CREATE_NAME => self::URL_PURPOSE_CREATE_PATH,
        self::URL_PURPOSE_LIST_NAME => self::URL_PURPOSE_LIST_PATH,
        self::URL_PURPOSE_DETAIL_NAME => self::URL_PURPOSE_DETAIL_PATH,
        self::URL_PURPOSE_UPDATE_NAME => self::URL_PURPOSE_UPDATE_PATH,
        self::URL_BALANCE_CREATE_NAME => self::URL_BALANCE_CREATE_PATH,
        self::URL_BALANCE_HISTORY_NAME => self::URL_BALANCE_HISTORY_PATH,
        self::URL_BALANCE_DETAIL_NAME => self::URL_BALANCE_DETAIL_PATH,
        self::URL_BALANCE_FINANCESINPURPOSE_NAME => self::URL_BALANCE_FINANCESINPURPOSE_PATH,
        self::URL_BALANCE_PURPOSESINFINANCE_NAME => self::URL_BALANCE_PURPOSESINFINANCE_PATH
    ];

    // ? Attributes Name
    public const URL_CONFIG_SYSTEM_ATTRIBUTES_NAME = 'config-system';

    public const URL_OWNER_CREATE_NAME = 'owner-create';
    public const URL_OWNER_UPDATE_CODE_NAME = 'owner-update-code';
    public const URL_OWNER_UPDATE_STATUS_NAME = 'owner-update-status';

    public const URL_FINANCE_CREATE_NAME = 'finance-create';
    public const URL_FINANCE_UPDATE_ACCOUNT_NAME = 'finance-update-code';
    public const URL_FINANCE_UPDATE_TYPE_NAME = 'finance-update-type';

    public const URL_PURPOSE_CREATE_NAME = 'purpose-create';
    public const URL_PURPOSE_LIST_NAME = 'purpose-list';
    public const URL_PURPOSE_DETAIL_NAME = 'purpose-detail';
    public const URL_PURPOSE_UPDATE_NAME = 'purpose-update';


    public const URL_BALANCE_CREATE_NAME = 'balance-create';
    public const URL_BALANCE_HISTORY_NAME = 'balance-history';
    public const URL_BALANCE_DETAIL_NAME = 'balance-detail';
    public const URL_BALANCE_FINANCESINPURPOSE_NAME = 'balance-finances-in-purpose';
    public const URL_BALANCE_PURPOSESINFINANCE_NAME = 'balance-purposes-in-finance';

    // ? Attributes Path
    public const URL_CONFIG_SYSTEM_ATTRIBUTES_PATH = 'system/config-system-attributes';

    public const URL_OWNER_CREATE_PATH = 'owner/create';
    public const URL_OWNER_UPDATE_CODE_PATH = 'owner/update-code';
    public const URL_OWNER_UPDATE_STATUS_PATH = 'owner/update-status';

    public const URL_FINANCE_CREATE_PATH = 'finance/create';
    public const URL_FINANCE_UPDATE_ACCOUNT_PATH = 'finance/update-account';
    public const URL_FINANCE_UPDATE_TYPE_PATH = 'finance/update-type';

    public const URL_PURPOSE_CREATE_PATH = 'purpose/create';
    public const URL_PURPOSE_LIST_PATH = 'purpose/list';
    public const URL_PURPOSE_DETAIL_PATH = 'purpose/detail';
    public const URL_PURPOSE_UPDATE_PATH = 'purpose/update';

    public const URL_BALANCE_CREATE_PATH = 'balance/create-transaction';
    public const URL_BALANCE_HISTORY_PATH = 'balance/transaction-histories';
    public const URL_BALANCE_DETAIL_PATH = 'balance/detail-transaction';
    public const URL_BALANCE_FINANCESINPURPOSE_PATH = 'balance/list-finances-in-purpose';
    public const URL_BALANCE_PURPOSESINFINANCE_PATH = 'balance/list-purposes-in-finance';
}
