<?php
# Generated by the Magento PHP proto generator.  DO NOT EDIT!

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogStorefrontApi\Api\Data;

/**
 * Autogenerated description for CategoriesGetResponse interface
 *
 * @SuppressWarnings(PHPMD.BooleanGetMethodName)
 */
interface CategoriesGetResponseInterface
{
    /**
     * Autogenerated description for getItems() interface method
     *
     * @return \Magento\CatalogStorefrontApi\Api\Data\CategoryInterface[]
     */
    public function getItems(): array;

    /**
     * Autogenerated description for setItems() interface method
     *
     * @param \Magento\CatalogStorefrontApi\Api\Data\CategoryInterface[] $value
     * @return void
     */
    public function setItems(array $value): void;
}
