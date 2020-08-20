<?php
# Generated by the Magento PHP proto generator.  DO NOT EDIT!

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogStorefrontApi\Api\Data;

/**
 * Autogenerated description for BundleItemOption class
 *
 * phpcs:disable Magento2.PHP.FinalImplementation
 * @SuppressWarnings
 */
final class BundleItemOption implements BundleItemOptionInterface
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var bool
     */
    private $isDefault;

    /**
     * @var float
     */
    private $price;

    /**
     * @var string
     */
    private $priceType;

    /**
     * @var bool
     */
    private $canChangeQuantity;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $entityId;

    /**
     * @var int
     */
    private $position;
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->id;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setId(string $value): void
    {
        $this->id = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return float
     */
    public function getQuantity(): float
    {
        return (float) $this->quantity;
    }
    
    /**
     * @inheritdoc
     *
     * @param float $value
     * @return void
     */
    public function setQuantity(float $value): void
    {
        $this->quantity = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return bool
     */
    public function getIsDefault(): bool
    {
        return (bool) $this->isDefault;
    }
    
    /**
     * @inheritdoc
     *
     * @param bool $value
     * @return void
     */
    public function setIsDefault(bool $value): void
    {
        $this->isDefault = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return float
     */
    public function getPrice(): float
    {
        return (float) $this->price;
    }
    
    /**
     * @inheritdoc
     *
     * @param float $value
     * @return void
     */
    public function setPrice(float $value): void
    {
        $this->price = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getPriceType(): string
    {
        return (string) $this->priceType;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setPriceType(string $value): void
    {
        $this->priceType = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return bool
     */
    public function getCanChangeQuantity(): bool
    {
        return (bool) $this->canChangeQuantity;
    }
    
    /**
     * @inheritdoc
     *
     * @param bool $value
     * @return void
     */
    public function setCanChangeQuantity(bool $value): void
    {
        $this->canChangeQuantity = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getLabel(): string
    {
        return (string) $this->label;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setLabel(string $value): void
    {
        $this->label = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getEntityId(): string
    {
        return (string) $this->entityId;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setEntityId(string $value): void
    {
        $this->entityId = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return int
     */
    public function getPosition(): int
    {
        return (int) $this->position;
    }
    
    /**
     * @inheritdoc
     *
     * @param int $value
     * @return void
     */
    public function setPosition(int $value): void
    {
        $this->position = $value;
    }
}
