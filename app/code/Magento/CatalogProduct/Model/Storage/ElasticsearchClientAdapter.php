<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Magento\CatalogProduct\Model\Storage;

use Magento\CatalogProduct\Model\Storage\Data\DocumentFactory;
use Magento\CatalogProduct\Model\Storage\Data\DocumentIteratorFactory;
use Magento\CatalogProduct\Model\Storage\Data\EntryInterface;
use Magento\CatalogProduct\Model\Storage\Data\EntryIteratorInterface;
use Magento\Framework\App\DeploymentConfig\Reader;
use Magento\Framework\Exception\BulkException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ConfigurationMismatchException;
use Magento\Framework\Config\File\ConfigFilePool;

/**
 * Elasticsearch client adapter.
 */
class ElasticsearchClientAdapter implements ClientInterface
{
    /**#@+
     * Text flags for Elasticsearch bulk actions
     */
    const BULK_ACTION_INDEX = 'index';
    const BULK_ACTION_CREATE = 'create';
    const BULK_ACTION_DELETE = 'delete';
    const BULK_ACTION_UPDATE = 'update';
    /**#@-*/


    /**
     * @var \Elasticsearch\Client[]
     */
    private $connectionPull;

    /**
     * @var array
     */
    private $clientOptions;

    /**
     * @var DocumentFactory
     */
    private $documentFactory;

    /**
     * @var DocumentIteratorFactory
     */
    private $documentIteratorFactory;

    /**
     * Initialize Elasticsearch Client
     *
     * @param Reader $configReader
     * @param DocumentFactory $documentFactory
     * @param DocumentIteratorFactory $documentIteratorFactory
     * @throws ConfigurationMismatchException
     * @throws \Magento\Framework\Exception\FileSystemException
     * @throws \Magento\Framework\Exception\RuntimeException
     */
    public function __construct(
        Reader $configReader,
        DocumentFactory $documentFactory,
        DocumentIteratorFactory $documentIteratorFactory
    )
    {
        $this->documentFactory = $documentFactory;
        $this->documentIteratorFactory = $documentIteratorFactory;
        $configData = $configReader->load(ConfigFilePool::APP_ENV)['catalog-store-front'];
        $options = $configData['connections']['default'];

        if (empty($options['hostname']) || ((!empty($options['enableAuth']) &&
                    ($options['enableAuth'] == 1)) && (empty($options['username']) || empty($options['password'])))) {
            throw new ConfigurationMismatchException(
                __('The search failed because of a search engine misconfiguration.')
            );
        }

        $config = $this->buildConfig($options);
        $elasticsearchClient = \Elasticsearch\ClientBuilder::fromConfig($config, true);

        $this->connectionPull[getmypid()] = $elasticsearchClient;
        $this->clientOptions = $options;
    }

    /**
     * Get Elasticsearch connection.
     *
     * @return \Elasticsearch\Client
     */
    private function getConnection()
    {
        $pid = getmypid();
        if (!isset($this->client[$pid])) {
            $config = $this->buildConfig($this->clientOptions);
            $this->connectionPull[$pid] = \Elasticsearch\ClientBuilder::fromConfig($config, true);
        }
        return $this->connectionPull[$pid];
    }

    /**
     * Build config.
     *
     * @param array $options
     * @return array
     */
    private function buildConfig($options = [])
    {
        $portString = '';
        if (!empty($options['port'])) {
            $portString = ':' . $options['port'];
        }

        $host = $options['protocol'] . '://' . $options['hostname'] . $portString;

        $options['hosts'] = [$host];

        return $options;
    }

    /**
     * @inheritdoc
     */
    public function createDataSource($name, $metadata)
    {
        try {
            $this->getConnection()->indices()->create(
                [
                    'index' => $name,
                    'body' => $metadata,
                ]
            );
        } catch (\Throwable $throwable) {
            throw new CouldNotSaveException(
                __("Error occurred while saving '$name' index."),
                $throwable
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function deleteDataSource($name)
    {
        try {
            $this->getConnection()->indices()->delete(['index' => $name]);
        } catch (\Throwable $throwable) {
            throw new CouldNotDeleteException(
                __("Error occurred while deleting '$name' index."),
                $throwable
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function createEntity(string $dataSourceName, string $entityName, array $schema)
    {
        $params = [
            'index' => $dataSourceName,
            'type' => $entityName,
            'body' => [
                $entityName => [
                    'dynamic_templates' => [
                        [
                            'default_mapping' => [
                                'match' => '*',
                                'match_mapping_type' => '*',
                                'mapping' => [
                                    'index' => false,
                                ],
                            ],
                        ]
                    ],
                ],
            ],
        ];

        foreach ($schema as $field => $fieldInfo) {
            $params['body'][$entityName]['properties'][$field] = $fieldInfo;
        }

        try {
            $this->getConnection()->indices()->putMapping($params);
        } catch (\Throwable $throwable) {
            throw new CouldNotSaveException(
                __("Error occurred while saving '$entityName' entity in the '$dataSourceName' index."),
                $throwable
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function createAlias(string $aliasName, string $dataSourceName)
    {
        $params['body']['actions'] = [
            'add' => ['alias' => $aliasName, 'index' => $dataSourceName],
        ];

        try {
            $this->getConnection()->indices()->updateAliases($params);
        } catch (\Throwable $throwable) {
            throw new StateException(
                __("Error occurred while creating alias for '$dataSourceName' index."),
                $throwable
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function switchAlias(string $aliasName, string $oldDataSourceName, string $newDataSourceName)
    {
        $params['body']['actions'] = [
            'add' => ['alias' => $aliasName, 'index' => $newDataSourceName],
            'remove' => ['alias' => $aliasName, 'index' => $oldDataSourceName]
        ];

        try {
            $this->getConnection()->indices()->updateAliases($params);
        } catch (\Throwable $throwable) {
            throw new StateException(
                __("Error occurred while switching alias "
                    . "from '$oldDataSourceName' index to '$newDataSourceName' index."),
                $throwable
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function getEntry(string $aliasName, string $entityName, int $id, array $fields): EntryInterface
    {
        $query = [
            'index' => $aliasName,
            'type' => $entityName,
            'id' => $id,
            '_source' => $fields
        ];
        try {
            $result = $this->getConnection()->get($query);
        } catch (\Throwable $throwable) {
            throw new NotFoundException(
                __("'$entityName' type document with id '$id' not found in index '$aliasName'."),
                $throwable
            );
        }

        return $this->documentFactory->create(['data' => $result]);
    }

    /**
     * @inheritdoc
     */
    public function getEntries(string $aliasName, string $entityName, array $ids, array $fields): EntryIteratorInterface
    {
        $query = [
            'index' => $aliasName,
            'type' => $entityName,
            'body' => ['ids' => $ids],
            '_source' => $fields
        ];
        try {
            $result = $this->getConnection()->mget($query);
        } catch (\Throwable $throwable) {
            throw new NotFoundException(
                __(
                    "'$entityName' type documents with ids '"
                    . print_r($ids, true)
                    . "' not found in index '$aliasName'."
                ),
                $throwable
            );
        }

        $documents = [];
        foreach ($result['docs'] as $item) {
            $documents[] = $this->documentFactory->create(['data' => $item]);
        }
        return $this->documentIteratorFactory->create(['documents' => $documents]);
    }

    /**
     * @inheritdoc
     */
    public function bulkInsert(string $dataSourceName, string $entityName, array $entries)
    {
        $query = $this->getDocsArrayInBulkIndexFormat($dataSourceName, $entityName, $entries);
        try {
            $this->getConnection()->bulk($query);
        } catch (\Throwable $throwable) {
            throw new BulkException(
                __("Error occurred while bulk insert to '$dataSourceName' index."),
                $throwable
            );
        }
    }

    /**
     * Reformat documents array to bulk format.
     *
     * @param string $indexName
     * @param string $entityName
     * @param array $documents
     * @param string $action
     * @return array
     */
    private function getDocsArrayInBulkIndexFormat(
        string $indexName,
        string $entityName,
        array $documents,
        string $action = self::BULK_ACTION_INDEX
    ): array {
        $bulkArray = [
            'index' => $indexName,
            'type' => $entityName,
            'body' => [],
            'refresh' => true,
        ];

        foreach ($documents as $document) {
            $bulkArray['body'][] = [
                $action => [
                    '_id' => $document['id'],
                    '_type' => $entityName,
                    '_index' => $indexName
                ]
            ];
            if ($action == self::BULK_ACTION_INDEX) {
                $bulkArray['body'][] = $document;
            }
        }

        return $bulkArray;
    }
}
