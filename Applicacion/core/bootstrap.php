<?php

use App\Core\App;
use App\Core\Database\QueryBuilder;
use App\Core\Database\Connection;
use App\Core\Logger;
use Monolog\Logger as MonologLogger;

/**
 * Load config
 */
App::bind('config', require 'config.php');

/**
 * Load database connection
 */
App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

/**
 * Load logger object
 */
App::bind('logger', Logger::getLogger(App::get('config')['logger']['level']));

/**
 * Load template engine
 */
$loader = new \Twig\Loader\FilesystemLoader(App::get('config')['twig']['templates_dir']);
$twig = new \Twig\Environment($loader, array(
    'cache' => App::get('config')['twig']['templates_cache_dir'],
    'debug' => true,
));
App::bind('twig', $twig);
