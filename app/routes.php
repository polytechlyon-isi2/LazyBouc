<?php

// Home page
$app->get('/', "LazyBouc\Controller\HomeController::indexAction")->bind('home');

$app->match('/genre/{id}', "LazyBouc\Controller\HomeController::genreAction")->bind('genre');

$app->match('/book/{id}', "LazyBouc\Controller\HomeController::bookAction")->bind('book');

$app->get('/login', "LazyBouc\Controller\HomeController::loginAction")->bind('login');

