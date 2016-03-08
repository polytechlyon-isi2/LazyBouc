<?php

// Home page
$app->get('/', "LazyBouc\Controller\HomeController::indexAction")->bind('home');

$app->match('/genre/{id}', "LazyBouc\Controller\HomeController::genreAction")->bind('genre');

$app->match('/book/{id}', "LazyBouc\Controller\HomeController::bookAction")->bind('book');

$app->get('/login', "LazyBouc\Controller\HomeController::loginAction")->bind('login');

$app->get('/admin', "LazyBouc\Controller\AdminController::indexAction")->bind('admin');

$app->match('/user/add', "LazyBouc\Controller\AdminController::addUserAction")->bind('useradd');

$app->match('/user/edit', "LazyBouc\Controller\AdminController::editUserAction")->bind('useredit');

//$app->get('/signup', "LazyBouc\Controller\HomeController::signupAction")->bind('login');

