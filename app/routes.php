<?php

use Symfony\Component\HttpFoundation\Request;
use LazyBouc\Domain\Comment;
use LazyBouc\Form\Type\CommentType;

// Home page
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
})->bind('home');