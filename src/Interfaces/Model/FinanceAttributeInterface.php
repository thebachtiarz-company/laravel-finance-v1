<?php

namespace TheBachtiarz\Finance\Interfaces\Model;

interface FinanceAttributeInterface
{
    /**
     * Model attributes fillable
     *
     * @var array
     */
    public const FINANCE_ATTRIBUTES_FILLABLE = [
        self::FINANCE_ATTRIBUTE_CODE,
        self::FINANCE_ATTRIBUTE_TYPE,
        self::FINANCE_ATTRIBUTE_VALUE
    ];

    public const FINANCE_ATTRIBUTE_ID = 'id';
    public const FINANCE_ATTRIBUTE_CODE = 'code';
    public const FINANCE_ATTRIBUTE_TYPE = 'type';
    public const FINANCE_ATTRIBUTE_VALUE = 'value';

    /**
     * Finance types available
     *
     * @var array
     */
    public const FINANCE_TYPES_AVAILABLE = [
        self::FINANCE_TYPE_OWNERCODE_CODE => self::FINANCE_TYPE_OWNERCODE_NAME,
        self::FINANCE_TYPE_FINANCECACCOUNT_CODE => self::FINANCE_TYPE_FINANCECACCOUNT_NAME,
        self::FINANCE_TYPE_PURPOSECODE_CODE => self::FINANCE_TYPE_PURPOSECODE_NAME
    ];

    public const FINANCE_TYPE_OWNERCODE_CODE = 'owc';
    public const FINANCE_TYPE_FINANCECACCOUNT_CODE = 'fac';
    public const FINANCE_TYPE_PURPOSECODE_CODE = 'puc';

    public const FINANCE_TYPE_OWNERCODE_NAME = 'Owner Code';
    public const FINANCE_TYPE_FINANCECACCOUNT_NAME = 'Finance Account';
    public const FINANCE_TYPE_PURPOSECODE_NAME = 'Purpose Code';

    // ? Getter Modules
    /**
     * Get code
     *
     * @return string|null
     */
    public function getCode(): ?string;

    /**
     * Get type
     *
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * Get value
     *
     * @return string|null
     */
    public function getValue(): ?string;

    // ? Setter Modules
    /**
     * Set code
     *
     * @param string $code
     * @return self
     */
    public function setCode(string $code): self;

    /**
     * Set type
     *
     * @param string $type
     * @return self
     */
    public function setType(string $type): self;

    /**
     * Set value
     *
     * @param string $value
     * @return self
     */
    public function setValue(string $value): self;
}
