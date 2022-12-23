<?php

namespace TheBachtiarz\Finance\Traits\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use TheBachtiarz\Finance\Interfaces\Model\FinanceAttributeInterface;

/**
 * Finance Attribute Scope Trait
 */
trait FinanceAttributeScopeTrait
{
    //

    /**
     * Get by code
     *
     * @param Builder $builder
     * @param string $code
     * @return Builder
     */
    public function scopeGetByCode(Builder $builder, string $code): Builder
    {
        $_codeAttribute = FinanceAttributeInterface::FINANCE_ATTRIBUTE_CODE;

        return $builder->where(DB::raw("BINARY `$_codeAttribute`"), $code);
    }

    /**
     * Get by type
     *
     * @param Builder $builder
     * @param string $type
     * @return Builder
     */
    public function scopeGetByType(Builder $builder, string $type): Builder
    {
        return $builder->where(FinanceAttributeInterface::FINANCE_ATTRIBUTE_TYPE, $type);
    }

    /**
     * Get by code and type
     *
     * @param Builder $builder
     * @param string $code
     * @param string $type
     * @return Builder
     */
    public function scopeGetByCodeType(Builder $builder, string $code, string $type): Builder
    {
        return $builder->getByCode($code)->getByType($type);
    }
}
