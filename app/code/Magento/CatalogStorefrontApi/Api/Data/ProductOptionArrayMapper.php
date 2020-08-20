<?php
# Generated by the Magento PHP proto generator.  DO NOT EDIT!

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogStorefrontApi\Api\Data;

use Magento\Framework\ObjectManagerInterface;

/**
 * Autogenerated description for ProductOption class
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 * @SuppressWarnings(PHPMD.UnusedPrivateField)
 * @SuppressWarnings(PHPMD.NPathComplexity)
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 */
final class ProductOptionArrayMapper
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
    * Convert the DTO to the array with the data
    *
    * @param ProductOption $dto
    * @return array
    */
    public function convertToArray(ProductOption $dto)
    {
        $result = [];
        $result["id"] = $dto->getId();
        $result["label"] = $dto->getLabel();
        $result["sort_order"] = $dto->getSortOrder();
        $result["required"] = $dto->getRequired();
        $result["render_type"] = $dto->getRenderType();
        /** Convert complex Array field **/
        $fieldArray = [];
        foreach ($dto->getValues() as $fieldArrayDto) {
            $fieldArray[] = $this->objectManager->get(\Magento\CatalogStorefrontApi\Api\Data\ProductOptionValueArrayMapper::class)
                ->convertToArray($fieldArrayDto);
        }
        $result["values"] = $fieldArray;
        return $result;
    }
}
