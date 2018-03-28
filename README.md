# 修正於後台Marketing>Catalog Price Rule中使用日期作為條件時 無法woke的問題

<br>

### 適用版本：
* Magento 2

<br>

### Original Code

```php

    protected function _prepareDatetimeValue($value, \Magento\Framework\Model\AbstractModel $model)
    {
        $attribute = $model->getResource()->getAttribute($this->getAttribute());
        if ($attribute && $attribute->getBackendType() == 'datetime') {
            $value = strtotime($value);
        }

        return $value;
    }

```
<br>

### Change to

```php
    
    protected function _prepareDatetimeValue($value, \Magento\Framework\Model\AbstractModel $model)
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

```
<br>

