<?php
/**
 * Serving static files when the server will run via PHP CLI server
 */
if (PHP_SAPI == 'cli-server') {
    $url = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

/**
 * This ROOT_DIR global variable determine the application location inside a container or instance.
 * All the other filesystems like cache, templates, logs, etc will be served based on this ROOT_DIR
 */
define("ROOT_DIR", dirname(__DIR__));

/**
 * All third-party packages loader which was installed through composer.json
 */
require ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

/**
 * Bootstrap file holds the pre-lunch application logic like starting session, set custom session handler or other pre-configurable stuff.
 */
require ROOT_DIR . DIRECTORY_SEPARATOR . 'application/bootstrap.php';

/**
 * Instantiate Slim application with 'settings' container. Settings will be generated based on global application config.php file
 */
$config = new \Noodlehaus\Config(ROOT_DIR . DIRECTORY_SEPARATOR . "config.php");
$app = new \Slim\App(['settings' => $config->get('app')]);

/**
 * Register all the dependency with Slim core. After registering dependency inside slim container, you will
 * be able to use them directly from inside routes and $app context with $this handle.
 *
 * For example, if you just add $container['myObject'] as a callable you can use this inside routes as $this->myObject in $app context
 */
require ROOT_DIR . DIRECTORY_SEPARATOR . 'application/dependencies.php';

/**
 * Attach all the routes for this slim application
 */
require ROOT_DIR . DIRECTORY_SEPARATOR . 'application/routes.php';

/**
 * Run the application
 */
$app->run();