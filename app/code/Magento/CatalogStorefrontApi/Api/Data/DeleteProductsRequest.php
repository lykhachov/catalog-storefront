<?php
# Generated by the Magento PHP proto generator.  DO NOT EDIT!

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogStorefrontApi\Api\Data;

/**
 * Autogenerated description for DeleteProductsRequest class
 *
 * phpcs:disable Magento2.PHP.FinalImplementation
 * @SuppressWarnings
 */
final class DeleteProductsRequest implements DeleteProductsRequestInterface
{

    /**
     * @var array
     */
    private $productIds;

    /**
     * @var string
     */
    private $store;
    
    /**
     * @inheritdoc
     *
     * @return string[]
     */
    public function getProductIds(): array
    {
        return (array) $this->productIds;
    }
    
    /**
     * @inheritdoc
     *
     * @param string[] $value
     * @return void
     */
    public function setProductIds(array $value): void
    {
        $this->productIds = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getStore(): string
    {
        return (string) $this->store;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setStore(string $value): void
    {
        $this->store = $value;
    }
}
