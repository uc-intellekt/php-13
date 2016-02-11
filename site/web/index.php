<?php

require_once __DIR__.'/../vendor/autoload.php';
//require_once __DIR__.'/../src/Controller/PostController.php';

use Silex\Application as App;

$app = new App();
$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'dbname' => 'php_15',
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'usbw',
        'port' => 3307,
    ),
));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->get('/', function() use($app) {
    return 'Welcome!';
});
$app->get('/hello/{userName}', function($userName) use($app) {
    return 'Hello '.$app->escape($userName);
});
$app->get('/blog', 'Controller\\PostController::indexAction');
$app->get('/blog/{id}', 'Controller\\PostController::showAction')
    ->method('GET')
    ->assert('id', '[0-9]+')
;

$app->run();
