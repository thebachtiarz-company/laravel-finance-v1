<?php

namespace TheBachtiarz\Finance\Services;

use Karate\Base\Modules\Finance\Repositories\FinanceAttributeRepository;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Finance\Interfaces\Config\UrlDomainInterface;
use TheBachtiarz\Finance\Interfaces\Model\FinanceAttributeInterface;
use TheBachtiarz\Finance\Logs\FinanceProcessLog;
use TheBachtiarz\Toolkit\Helper\Curl\AbstractCurl;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

class CurlService extends AbstractCurl
{
    //

    /**
     * Finance Attribute Repository
     *
     * @var FinanceAttributeRepository
     */
    protected FinanceAttributeRepository $financeAttributeRepository;

    /**
     * Finance attribute data cache
     *
     * @var array
     */
    private array $financeAttributeDataCache = [];

    /**
     * Constructor
     *
     * @param FinanceAttributeRepository $financeAttributeRepository
     */
    public function __construct(
        FinanceAttributeRepository $financeAttributeRepository
    ) {
        $this->financeAttributeRepository = $financeAttributeRepository;
    }

    // ? Public Methods
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

    // ? Protected Methods
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

    /**
     * Convert result data
     *
     * @param array $data
     * @param boolean $isDataPagination
     * @return array
     */
    protected function convertResultData(array $data, bool $isDataPagination = false): array
    {
        $_mutation = $isDataPagination ? $data['result'] : $data;

        foreach ($_mutation ?? [] as $key => &$value) {
            $_newAttribute = [];

            if (@$value[FinanceConfigInterface::ATTRIBUTE_OWNER_CODE]) {
                $_newAttribute[FinanceConfigInterface::ATTRIBUTE_OWNER_CODE . '_name'] = $this->getFinanceAttributeValue(
                    $value,
                    FinanceConfigInterface::ATTRIBUTE_OWNER_CODE,
                    FinanceAttributeInterface::FINANCE_TYPE_OWNERCODE_CODE
                );
            }

            if (@$value[FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT]) {
                $_newAttribute[FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT . '_name'] = $this->getFinanceAttributeValue(
                    $value,
                    FinanceConfigInterface::ATTRIBUTE_FINANCE_ACCOUNT,
                    FinanceAttributeInterface::FINANCE_TYPE_FINANCECACCOUNT_CODE
                );
            }

            if (@$value[FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE]) {
                $_newAttribute[FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE . '_name'] = $this->getFinanceAttributeValue(
                    $value,
                    FinanceConfigInterface::ATTRIBUTE_PURPOSE_CODE,
                    FinanceAttributeInterface::FINANCE_TYPE_PURPOSECODE_CODE
                );
            }

            $value = array_merge($value, $_newAttribute);
        }

        if ($isDataPagination) {
            $data['result'] = $_mutation;
        } else {
            $data = $_mutation;
        }

        return $data;
    }

    // ? Private Methods
    /**
     * Get finance attribute value
     *
     * @param array $data
     * @param string $attribute
     * @param string $type
     * @return string
     */
    private function getFinanceAttributeValue(array $data, string $attribute, string $type): string
    {
        if (!@$this->financeAttributeDataCache[$data[$attribute] . '_' . $type]) {
            $_financeAttribute = $this->financeAttributeRepository->getByCodeAndTypeOrFail($data[$attribute], $type);

            $this->financeAttributeDataCache[$data[$attribute] . '_' . $type] = $_financeAttribute?->getValue() ?? '-';
        }

        return $this->financeAttributeDataCache[$data[$attribute] . '_' . $type];
    }
}
