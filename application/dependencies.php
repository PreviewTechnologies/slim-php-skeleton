<?php
/**
 * Application wide middleware
 *
 */
$app->add(function (\Slim\Http\Request $request, \Slim\Http\Response $response, $next) {
    $response->getBody()->write('BEFORE');
    $response = $next($request, $response);
    $response->getBody()->write('AFTER');

    return $response;
});

/**
 * @var \Slim\Container $container
 */
$container = $app->getContainer();

/**
 * @param \Slim\Container $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function (\Slim\Container $container) {
    $settings = $container->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    $view->addExtension(new Twig_Extension_Debug());

    $twigExtra = $view->getEnvironment();
    $twigExtra->addGlobal('session', $_SESSION);

    //Access few config from view context
    $twigExtra->addGlobal('config', $settings);

    return $view;

};

/**
 * @param $c
 * @return \Monolog\Logger
 */
$container['logger'] = function ($c) {

    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());

    if (in_array('php://stdout', $settings['monolog_handlers'])) {
        $logger->pushHandler(new Monolog\Handler\StreamHandler('php://stdout', $settings['level']));
    }

    if (in_array('file', $settings['monolog_handlers'])) {
        $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    }

    return $logger;
};

/**
 * @param $c
 * @return \Slim\Flash\Messages
 */
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages();
};

/**
 * @param $c
 * @return \Noodlehaus\Config
 */
$container['config'] = function ($c) {
    return new \Noodlehaus\Config(dirname(__DIR__) . DIRECTORY_SEPARATOR . "config.php");
};

/**
 * If you don't need any database in this project just comment the following line
 */
/*use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

$capsule = new Capsule;
foreach ($container['settings']['databases'] as $key => $value) {
    $capsule->addConnection($value, $key);
}
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();*/
