<?php

/**
 * Class App
 * @property  config
 * @property  config
 */
class Dummy
{
    /**
     * @var array $settings
     */
    public $settings;
    /**
     * @var Memcached $memcache
     */

    public $memcache;
    /**
     * @var \Slim\Views\Twig $view
     */

    public $view;

    /**
     * @var \Monolog\Logger $logger
     */
    public $logger;

    /**
     * @var \Monolog\Logger $activitylog
     */
    public $activitylog;

    /**
     * @var Slim\Flash\Messages $flash
     */
    public $flash;
}