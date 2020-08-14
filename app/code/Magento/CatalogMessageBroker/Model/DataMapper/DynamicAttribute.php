<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\CatalogMessageBroker\Model\DataMapper;

/**
 * Class DynamicAttribute for dynamic mapping
 */
class DynamicAttribute implements DataMapperInterface
{
    /**
     * @var array
     */
    private $attributePool;

    /**
     * @param array $attributePool
     */
    public function __construct(array $attributePool)
    {
        $this->attributePool = $attributePool;
    }

    /**
     * @inheritDoc
     */
    public function map(array $productData): array
    {
        $dynamicAttributes = [];

        foreach ($productData['attributes'] ?? [] as $attribute) {
            $attributeType = $this->attributePool[$attribute['type']];
            if (!$attributeType instanceof \Magento\CatalogMessageBroker\Model\DataMapper\AttributeTypeInterface) {
                continue;
            }
            $dynamicAttributes[] = [
                'code' => $attribute['attribute_code'],
                'value' => $attributeType->getAttribute($attribute),
            ];
        }

        return ['dynamic_attributes' => $dynamicAttributes];
    }
}