<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Logs\FinanceProcessLog;
use TheBachtiarz\Toolkit\Helper\Curl\AbstractCurl;

class CurlService extends AbstractCurl
{
    /**
     * {@inheritDoc}
     *
     * With logger.
     */
    public function get(): array
    {
        $process = parent::get();

        FinanceProcessLog::status($process['status'] ?? false)->message($process['message'] ?? "")->log();

        return $process;
    }

    /**
     * {@inheritDoc}
     *
     * With logger.
     */
    public function post(): array
    {
        $process = parent::post();

        FinanceProcessLog::status($process['status'] ?? false)->message($process['message'] ?? "")->log();

        return $process;
    }

    /**
     * {@inheritDoc}
     */
    protected function urlDomainResolver(): string
    {
        $_baseDomain = tbfinanceconfig('base_url');
        $_prefix = tbfinanceconfig('api_prefix');
        $_endPoint = UrlDomainInterface::URL_AVAILABLE_OPTIONS[$this->getUrl()];

        return "{$_baseDomain}/{$_prefix}/{$_endPoint}";
    }

    /**
     * {@inheritDoc}
     */
    protected function bodyDataResolver(): array
    {
        return $this->body;
    }
}
