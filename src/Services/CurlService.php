<?php

namespace TheBachtiarz\Finance\Services;

use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Logs\FinanceProcessLog;
use TheBachtiarz\Toolkit\Helper\Curl\AbstractCurl;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class CurlService extends AbstractCurl
{
    /**
     * {@inheritDoc}
     *
     * With logger.
     */
    public function get(): CurlResolverData
    {
        $process = parent::get();

        FinanceProcessLog::status($process->getStatus() ?? false)->message($process->getMessage() ?? "")->log();

        return $process;
    }

    /**
     * {@inheritDoc}
     *
     * With logger.
     */
    public function post(): CurlResolverData
    {
        $process = parent::post();

        FinanceProcessLog::status($process->getStatus() ?? false)->message($process->getMessage() ?? "")->log();

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
