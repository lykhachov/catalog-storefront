<?php
# Generated by the Magento PHP proto generator.  DO NOT EDIT!

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogStorefrontApi\Api\Data;

/**
 * Autogenerated description for MediaGalleryItem class
 *
 * phpcs:disable Magento2.PHP.FinalImplementation
 * @SuppressWarnings
 */
final class MediaGalleryItem implements MediaGalleryItemInterface
{

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $mediaType;

    /**
     * @var int
     */
    private $position;

    /**
     * @var \Magento\CatalogStorefrontApi\Api\Data\VideoInterface
     */
    private $videoContent;
    
    /**
     * @inheritdoc
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->url;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setUrl(string $value): void
    {
        $this->url = $value;
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
    public function getMediaType(): string
    {
        return (string) $this->mediaType;
    }
    
    /**
     * @inheritdoc
     *
     * @param string $value
     * @return void
     */
    public function setMediaType(string $value): void
    {
        $this->mediaType = $value;
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
    
    /**
     * @inheritdoc
     *
     * @return \Magento\CatalogStorefrontApi\Api\Data\VideoInterface|null
     */
    public function getVideoContent(): ?\Magento\CatalogStorefrontApi\Api\Data\VideoInterface
    {
        return $this->videoContent;
    }
    
    /**
     * @inheritdoc
     *
     * @param \Magento\CatalogStorefrontApi\Api\Data\VideoInterface $value
     * @return void
     */
    public function setVideoContent(\Magento\CatalogStorefrontApi\Api\Data\VideoInterface $value): void
    {
        $this->videoContent = $value;
    }
}
