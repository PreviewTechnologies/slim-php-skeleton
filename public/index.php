<?php

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

define("ROOT_DIR", dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';

// Session start
session_start();

// Instantiate the app
$settings = require ROOT_DIR . DIRECTORY_SEPARATOR . 'application/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require ROOT_DIR . DIRECTORY_SEPARATOR . 'application/dependencies.php';

// Register routes
require ROOT_DIR . DIRECTORY_SEPARATOR . 'application/routes.php';

// Run app
$app->run();
