<?php

return array(
    'doctrine' => [
        'odm' => [
            'connection' => [
                'noauth' => [
                    'dbname' => 'zoop_test',
                    'server' => 'localhost',
                    'port' => '27017',
                    'user' => '',
                    'password' => '',
                ],
            ],
            'configuration' => [
                'noauth' => [
                    'metadata_cache' => 'doctrine.cache.array',
                    'default_db' => 'zoop_test',
                    'generate_proxies' => true,
                    'proxy_dir' => __DIR__ . '/../data/proxies',
                    'proxy_namespace' => 'proxies',
                    'generate_hydrators' => true,
                    'hydrator_dir' => __DIR__ . '/../data/hydrators',
                    'hydrator_namespace' => 'hydrators',
                    'driver' => 'doctrine.driver.default',
                ],
            ],
            'documentmanager' => [
                'noauth' => [
                    'connection' => 'doctrine.odm.connection.noauth',
                    'configuration' => 'doctrine.odm.configuration.noauth',
                    'eventmanager' => 'doctrine.eventmanager.noauth'
                ]
            ],
        ],
    ],
    'zoop' => [
        'shard' => [
            'manifest' => [
                'noauth' => [
                    'model_manager' => 'doctrine.odm.documentmanager.noauth',
                    'extension_configs' => [
                        'extension.odmcore' => true,
                    ],
                    'models' => []
                ]
            ],
        ]
    ],
);
