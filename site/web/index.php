<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application as App;

$app = new App();

$app->get('/', function() use($app) {
    return 'Welcome!';
});
$app->get('/hello/{userName}', function($userName) use($app) {
    return 'Hello '.$app->escape($userName);
});

$app->run();
