<?php
// DIC configuration

/**
 * @var \Slim\Container
 */
$container = $app->getContainer();

// view renderer
$container['view'] = function (\Slim\Container $container) {
    $settings = $container->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    /** @noinspection PhpUndefinedMethodInspection */
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    $view->addExtension(new Twig_Extension_Debug());

    $twigExtra = $view->getEnvironment();
    $twigExtra->addGlobal('session', $_SESSION);

    return $view;

};


// monolog logs
$container['logger'] = function ($c) {
    /** @noinspection PhpUndefinedMethodInspection */
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};


// Flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages();
};

// Flash messages
$container['config'] = function ($c) {
    return dirname(__DIR__);
};


// an anonymous function