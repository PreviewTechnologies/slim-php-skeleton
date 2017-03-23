<?php
return [
    'app' => [
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => ROOT_DIR . DIRECTORY_SEPARATOR . 'templates/',
        ],
        // View settings
        'view' => [
            'template_path' => ROOT_DIR . DIRECTORY_SEPARATOR . 'templates/',
            'twig' => [
                'cache' => ROOT_DIR . DIRECTORY_SEPARATOR . "tmp/cache/twig",
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // Monolog settings
        'logger' => [
            'name' => 'previewtechs-accounts-portal',
            'path' => ROOT_DIR . DIRECTORY_SEPARATOR . 'logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
            'monolog_handlers' => ['php://stdout', 'file']
        ],

        'databases' => [
            'default' => [
                'driver' => 'mysql',
                'host' => 'HOST_NAME',
                'database' => 'NAME_OF_DATABASE',
                'username' => 'DATABASE_USERNAME',
                'password' => 'DATABASE_PASSWORD',
                'charset' => 'Utf8',
                'collation' => 'utf8_general_ci',
                'prefix' => '',
                'unix_socket' => null
            ]
        ]
    ]
];