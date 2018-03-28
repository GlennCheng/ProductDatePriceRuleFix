<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Catalog Rule Product Condition data model
 */
namespace AstralWeb\ProductDatePriceRuleFix\Model\Rule\Condition;

use Magento\CatalogRule\Model\Rule\Condition\Product as OriginalProduct;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Product
 * @package AstralWeb\ProductDatePriceRuleFix\Model\Rule\Condition
 */
class Product extends OriginalProduct
{
    /**
     * @param mixed $value
     * @param AbstractModel $model
     * @return false|int|mixed|null
     */
    protected function _prepareDatetimeValue($value, AbstractModel $model)
    {
        $attribute = $model->getResource()->getAttribute($this->getAttribute());
        if ($attribute && $attribute->getBackendType() == 'datetime') {
            if (!$value) {
                return null;
            }
            $this->setValue(strtotime($this->getValue()));
            $value = strtotime($value);
        }
        return $value;
    }

}
