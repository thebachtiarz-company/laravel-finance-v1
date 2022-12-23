<?php

namespace TheBachtiarz\Finance\Models;

use Illuminate\Database\Eloquent\Model;
use TheBachtiarz\Finance\Interfaces\Model\FinanceAttributeInterface;
use TheBachtiarz\Finance\Traits\Model\FinanceAttributeScopeTrait;

class FinanceAttribute extends Model implements FinanceAttributeInterface
{
    use FinanceAttributeScopeTrait;

    /**
     * {@inheritDoc}
     */
    protected $fillable = self::FINANCE_ATTRIBUTES_FILLABLE;

    // ? Getter Modules
    /**
     * {@inheritDoc}
     */
    public function getCode(): ?string
    {
        return $this->__get(self::FINANCE_ATTRIBUTE_CODE);
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): ?string
    {
        return $this->__get(self::FINANCE_ATTRIBUTE_TYPE);
    }

    /**
     * {@inheritDoc}
     */
    public function getValue(): ?string
    {
        return $this->__get(self::FINANCE_ATTRIBUTE_VALUE);
    }

    // ? Setter Modules
    /**
     * {@inheritDoc}
     */
    public function setCode(string $code): self
    {
        $this->__set(self::FINANCE_ATTRIBUTE_CODE, $code);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setType(string $type): self
    {
        $this->__set(self::FINANCE_ATTRIBUTE_TYPE, $type);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setValue(string $value): self
    {
        $this->__set(self::FINANCE_ATTRIBUTE_VALUE, $value);

        return $this;
    }
}
