<?php
use ISA\Workshop\BlogController;

require('../vendor/autoload.php');

$dbConfiguration = [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => '127.0.0.1',
        'dbname'    => 'isa_blog',
        'user'      => 'root',
        'password'  => 'infoShareAcademy',
        'charset'   => 'utf8',
    ],
];

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), ['twig.path' => __DIR__.'/views']);
$app->register(new Silex\Provider\DoctrineServiceProvider(), $dbConfiguration);
$app->register(new Silex\Provider\ServiceControllerServiceProvider());

$app['blog.controller'] = function() use ($app) {
    $blogRepository = new \ISA\Workshop\BlogRepository($app['db']);
    return new BlogController($blogRepository, $app['twig']);
};

// routing
$app->get('/', 'blog.controller:showHomePage');
$app->get('/posts', 'blog.controller:showPostsCollection');
$app->get('/posts/{postId}', 'blog.controller:showSinglePost');
$app->get('/about','blog.controller:showAbout');
$app->get('/gallery','blog.controller:showGallery');
$app->get('/authorPosts/{authorName}','blog.controller:ShowPostsByAuthor');

// run app
$app->run();
