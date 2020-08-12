<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\CatalogStorefrontGraphQl\Resolver\Deprecated\CatalogCustomer;

use Magento\CatalogCustomerGraphQl\Model\Resolver\Customer\GetCustomerGroup;
use Magento\CatalogGraphQl\Model\Resolver\Product\Price\Discount;
use Magento\CatalogGraphQl\Model\Resolver\Product\Price\ProviderPool as PriceProviderPool;
use Magento\CatalogStorefrontGraphQl\Model\ProductModelHydrator;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\CatalogCustomerGraphQl\Model\Resolver\Product\Price\TiersFactory;
use Magento\Framework\Pricing\PriceCurrencyInterface;

/**
 * Override resolver of deprecated field. Add 'model' to output
 */
class PriceTiers extends \Magento\CatalogCustomerGraphQl\Model\Resolver\PriceTiers
{
    /**
     * @var ProductModelHydrator
     */
    private $productModelHydrator;

    /**
     * @param ValueFactory $valueFactory
     * @param TiersFactory $tiersFactory
     * @param GetCustomerGroup $getCustomerGroup
     * @param Discount $discount
     * @param PriceProviderPool $priceProviderPool
     * @param PriceCurrencyInterface $priceCurrency
     * @param ProductModelHydrator $productModelHydrator
     */
    public function __construct(
        ValueFactory $valueFactory,
        TiersFactory $tiersFactory,
        GetCustomerGroup $getCustomerGroup,
        Discount $discount,
        PriceProviderPool $priceProviderPool,
        PriceCurrencyInterface $priceCurrency,
        ProductModelHydrator $productModelHydrator
    ) {
        parent::__construct(
            $valueFactory,
            $tiersFactory,
            $getCustomerGroup,
            $discount,
            $priceProviderPool,
            $priceCurrency
        );
        $this->productModelHydrator = $productModelHydrator;
    }

    /**
     * @inheritdoc
     *
     * Add 'model' to $value
     *
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @throws \Exception
     * @return array
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $value = $this->productModelHydrator->hydrate($value);
        return parent::resolve($field, $context, $info, $value, $args);
    }
}
