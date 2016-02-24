<?php

require_once __DIR__.'/../vendor/autoload.php';
define('PARAMETER_PATH', __DIR__.'/../parameters.php');
if (is_file(PARAMETER_PATH)) {
    require_once PARAMETER_PATH;
} else {
    throw new RuntimeException('File with parameters not found!');
}
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
$app['admin.post.controller'] = $app->share(function() use ($app) {
    return new \Controller\Admin\PostController($app);
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
$app->get('/admin/blog', 'admin.post.controller:indexAction')
    ->bind('admin_post_index')
;
$app->get('/admin/blog/new', 'admin.post.controller:newAction')
    ->bind('admin_post_new')
    ->method('GET|POST')
;
$app->get('/admin/blog/edit/{id}', 'admin.post.controller:editAction')
    ->bind('admin_post_edit')
    ->method('GET|POST')
    ->assert('id', '[0-9]+')
;

$app->run();
