<?php
# Generated by the Magento PHP proto generator.  DO NOT EDIT!

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogStorefrontApi\Api\Data;

/**
 * Autogenerated description for ConfigurableOption class
 *
 * phpcs:disable Magento2.PHP.FinalImplementation
 * @SuppressWarnings
 */
final class ConfigurableOption implements ConfigurableOptionInterface
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $position;

    /**
     * @var string
     */
    private $useDefault;

    /**
     * @var string
     */
    private $productId;

    /**
     * @var string
     */
    private $attributeCode;

    /**
     * @var string
     */
    private $attributeId;

    /**
     * @var array
     */
    private $values;
    
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
    public function getPosition(): string
    {
        return (string) $this->position;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setPosition(string $value): void
    {
        $this->position = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getUseDefault(): string
    {
        return (string) $this->useDefault;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setUseDefault(string $value): void
    {
        $this->useDefault = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getProductId(): string
    {
        return (string) $this->productId;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setProductId(string $value): void
    {
        $this->productId = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getAttributeCode(): string
    {
        return (string) $this->attributeCode;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setAttributeCode(string $value): void
    {
        $this->attributeCode = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getAttributeId(): string
    {
        return (string) $this->attributeId;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setAttributeId(string $value): void
    {
        $this->attributeId = $value;
    }
    
    /**
     * @inheritdoc
     *
     * @return \Magento\CatalogStorefrontApi\Api\Data\ConfigurableOptionValueInterface[]
     */
    public function getValues(): array
    {
        return (array) $this->values;
    }
    
    /**
     * @inheritdoc
     *
     * @param \Magento\CatalogStorefrontApi\Api\Data\ConfigurableOptionValueInterface[] $value
     * @return void
     */
    public function setValues(array $value): void
    {
        $this->values = $value;
    }
}
