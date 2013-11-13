<?php
/**
 * SQLite database config
 */
return array(
    'db' => array(
        'driver' => 'pdo',
        'dsn'            => 'sqlite:' . __DIR__ . '/../../data/application/application',
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        )
    )

);
