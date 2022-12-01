<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Logs\FinanceProcessLog;
use TheBachtiarz\Toolkit\Helper\Curl\CurlRestService;

class CurlService
{
    use CurlRestService {
        get as public getOrigin;
        post as public postOrigin;
    }

    /**
     * {@inheritDoc}
     *
     * With logger.
     */
    public static function get(): array
    {
        $process = self::getOrigin();

        FinanceProcessLog::status($process['status'] ?? false)->message($process['message'] ?? "")->log();

        return $process;
    }

    /**
     * {@inheritDoc}
     *
     * With logger.
     */
    public static function post(): array
    {
        $process = self::postOrigin();

        FinanceProcessLog::status($process['status'] ?? false)->message($process['message'] ?? "")->log();

        return $process;
    }

    /**
     * {@inheritDoc}
     */
    private static function baseDomainResolver(): string
    {
        return tbfinanceconfig('base_url');
    }

    /**
     * {@inheritDoc}
     */
    private static function urlResolver(): string
    {
        $_baseDomain = self::baseDomainResolver();

        $_prefix = tbfinanceconfig('api_prefix');

        $_endPoint = UrlDomainInterface::URL_AVAILABLE_OPTIONS[self::$url];

        return "{$_baseDomain}/{$_prefix}/{$_endPoint}";
    }
}
