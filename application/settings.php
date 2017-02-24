<?php
return [
    'settings' => [
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
                //'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => ROOT_DIR . DIRECTORY_SEPARATOR . 'logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
