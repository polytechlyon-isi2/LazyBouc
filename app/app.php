<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app['dao.genre'] = $app->share(function ($app) {
    return new LazyBouc\DAO\GenreDAO($app['db']);
});
$app['dao.book'] = $app->share(function ($app) {
    $bookDAO = new LazyBouc\DAO\BookDAO($app['db']);
    $bookDAO->setGenreDAO($app['dao.genre']);
    return $bookDAO;
});
$app['dao.author'] = $app->share(function ($app) {
    $authorDAO = new LazyBouc\DAO\AuthorDAO($app['db']);
    $authorDAO->setGenreDAO($app['dao.genre']);
    return $authorDAO;
});
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => true,
            'form' => array('login_path' => '/login', 'check_path' => '/login_check'),
            'users' => $app->share(function () use ($app) {
                return new LazyBouc\DAO\UserDAO($app['db']);
            }),
        ),
    ),
));