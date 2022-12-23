<?php

namespace TheBachtiarz\Finance\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use TheBachtiarz\Finance\Models\FinanceAttribute;

class FinanceAttributeRepository
{
    //

    // ? Public Methods
    /**
     * Get by id
     *
     * @param integer $id
     * @return FinanceAttribute
     */
    public function getById(int $id): FinanceAttribute
    {
        $_financeAttribute = FinanceAttribute::find($id);

        if (!$_financeAttribute) throw new ModelNotFoundException("Finance attribute with id '$id' not found");

        return $_financeAttribute;
    }

    /**
     * Get by code
     *
     * @param string $code
     * @return FinanceAttribute
     */
    public function getByCode(string $code): FinanceAttribute
    {
        $_financeAttribute = FinanceAttribute::getByCode($code)->first();

        if (!$_financeAttribute) throw new ModelNotFoundException("Finance attribute with code '$code' not found");

        return $_financeAttribute;
    }

    /**
     * Get by type
     *
     * @param string $type
     * @return Collection
     */
    public function getByType(string $type): Collection
    {
        $_financeAttributes = FinanceAttribute::getByType($type);

        if (!$_financeAttributes->count()) throw new ModelNotFoundException("Finance attribute with type '$type' not found");

        return $_financeAttributes->get();
    }

    /**
     * Get by code and type
     *
     * @param string $code
     * @param string $type
     * @return FinanceAttribute
     */
    public function getByCodeAndType(string $code, string $type): FinanceAttribute
    {
        $_financeAttribute = FinanceAttribute::getByCodeType($code, $type)->first();

        if (!$_financeAttribute) throw new ModelNotFoundException("Finance attribute with this condition not found");

        return $_financeAttribute;
    }

    /**
     * Create new finance attribute
     *
     * @param FinanceAttribute $financeAttribute
     * @return FinanceAttribute
     */
    public function create(FinanceAttribute $financeAttribute): FinanceAttribute
    {
        $_data = [];

        foreach ($financeAttribute->getFillable() as $key => $attribute) {
            $_data[$attribute] = $financeAttribute->__get($attribute);
        }

        $_create = FinanceAttribute::create($_data);

        if (!$_create) throw new ModelNotFoundException("Failed to create new finance attribute");

        return $_create;
    }

    /**
     * Update curent finance attribute
     *
     * @param FinanceAttribute $financeAttribute
     * @return FinanceAttribute
     */
    public function save(FinanceAttribute $financeAttribute): FinanceAttribute
    {
        $_financeAttribute = $financeAttribute->save();

        if (!$_financeAttribute) throw new ModelNotFoundException("Failed to save current finance attribute");

        return $financeAttribute;
    }

    /**
     * Delete by id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById(int $id): bool
    {
        return $this->getById($id)->delete();
    }

    /**
     * Delete by code
     *
     * @param string $code
     * @return boolean
     */
    public function deleteByCode(string $code): bool
    {
        return $this->getByCode($code)->delete();
    }

    // ? Private Methods

    // ? Setter Modules
}
