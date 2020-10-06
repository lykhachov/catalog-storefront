<?php
# Generated by the Magento PHP proto generator.  DO NOT EDIT!

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogStorefrontApi\Api\Data;

/**
 * Autogenerated description for ImportProductDataRequest class
 *
 * phpcs:disable Magento2.PHP.FinalImplementation
 * @SuppressWarnings(PHPMD)
 * @SuppressWarnings(PHPCPD)
 */
final class ImportProductDataRequest implements ImportProductDataRequestInterface
{

    /**
     * @var \Magento\CatalogStorefrontApi\Api\Data\ProductInterface
     */
    private $product;

    /**
     * @var array
     */
    private $attributes;
    
    /**
     * @inheritdoc
     *
     * @return \Magento\CatalogStorefrontApi\Api\Data\ProductInterface|null
     */
    public function getProduct(): ?\Magento\CatalogStorefrontApi\Api\Data\ProductInterface
    {
        return $this->product;
    }
    
    /**
     * @inheritdoc
     *
     * @param \Magento\CatalogStorefrontApi\Api\Data\ProductInterface $value
     * @return void
     */
    public function setProduct(\Magento\CatalogStorefrontApi\Api\Data\ProductInterface $value): void
    {
        $this->product = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string[]
     */
    public function getAttributes(): array
    {
        return (array) $this->attributes;
    }
    
    /**
     * @inheritdoc
     *
     * @param string[] $value
     * @return void
     */
    public function setAttributes(array $value): void
    {
        $this->attributes = $value;
    }
}