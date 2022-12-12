<?php

namespace TheBachtiarz\Finance\Traits\Service;

use TheBachtiarz\Finance\Helpers\ConfigSystemHelper;
use TheBachtiarz\Finance\Interfaces\Config\FinanceConfigInterface;
use TheBachtiarz\Toolkit\Helper\Curl\Data\CurlResolverData;

/**
 * Owner Body Data Trait
 */
trait OwnerBodyDataTrait
{
    //

    /**
     * Owner code
     *
     * @var string|null
     */
    protected ?string $ownerCode = null;

    // ? Public Methods
    /**
     * Owner body data resolver
     *
     * @return CurlResolverData
     */
    public function ownerBodyDataResolver(): CurlResolverData
    {
        $result = ['status' => false, 'data' => null, 'message' => ''];

        try {
            throw_if(tbfinanceconfig('is_multi_owner') && !$this->ownerCode, 'Exception', "Owner code required");

            $ownerCode = tbfinanceconfig('is_multi_owner')
                ? $this->ownerCode
                : tbfinanceconfig(ConfigSystemHelper::getConfig(FinanceConfigInterface::ATTRIBUTE_OWNER_CODE));

            $result['status'] = true;
            $result['data'] = $ownerCode;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
        } finally {
            return new CurlResolverData($result);
        }
    }

    // ? Private Methods

    // ? Setter Modules
    /**
     * Set owner code
     *
     * @param string|null $ownerCode
     * @return static
     */
    public function setOwnerCode(?string $ownerCode): static
    {
        $this->ownerCode = $ownerCode;

        return $this;
    }
}
