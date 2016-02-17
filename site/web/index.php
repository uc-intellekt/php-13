<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../parameters.php';
//require_once __DIR__.'/../src/Controller/PostController.php';

use Silex\Application as App;

$app = new App();
$app['debug'] = true;

// Service Providers
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $parameters['db'],
));
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => $parameters['twig']['path'],
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Services
$app['post.controller'] = $app->share(function() use ($app) {
    return new \Controller\PostController($app);
});

// Routes
$app->get('/', function() use($app) {
    return 'Welcome!';
});
$app->get('/hello/{userName}', function($userName) use($app) {
    return 'Hello '.$app->escape($userName);
});
$app->get('/blog', 'post.controller:indexAction')
    ->bind('post_index')
;
$app->get('/blog/{id}', 'post.controller:showAction')
    ->bind('post_show')
    ->method('GET')
    ->assert('id', '[0-9]+')
;

$app->run();
