<?php
require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__.'/views',
]);

// routing
$app->get('/', '\\ISA\\Workshop\\BlogController::showHomePage');

// run app
$app->run();
