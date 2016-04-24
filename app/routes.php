<?php

// Home page
$app->get('/', "LazyBouc\Controller\HomeController::indexAction")->bind('home');

$app->match('/genre/{id}', "LazyBouc\Controller\HomeController::genreAction")->bind('genre');

$app->match('/book/{id}', "LazyBouc\Controller\HomeController::bookAction")->bind('book');

$app->get('/login', "LazyBouc\Controller\HomeController::loginAction")->bind('login');

$app->get('/admin', "LazyBouc\Controller\AdminController::indexAction")->bind('admin');

$app->match('/admin/user/edit/{id}', "LazyBouc\Controller\AdminController::editAdminUserAction")->bind('adminuseredit');

$app->match('/admin/user/add', "LazyBouc\Controller\AdminController::addUserAction")->bind('adminuseradd');

$app->match('/admin/user/delete/{id}', "LazyBouc\Controller\AdminController::deleteUserAction")->bind('adminuserdelete');

$app->match('/signup', "LazyBouc\Controller\AdminController::addUserAction")->bind('useradd');

$app->match('/user/edit', "LazyBouc\Controller\AdminController::editUserAction")->bind('useredit');

$app->match('/user/cart/add/{id}', "LazyBouc\Controller\HomeController::addCartAction")->bind('addtocart');

$app->match('/user/cart/delete/{id}', "LazyBouc\Controller\HomeController::deleteCartAction")->bind('deleteincart');

$app->get('/user/cart', "LazyBouc\Controller\HomeController::cartAction")->bind('cart');

$app->match('/admin/book/add', "LazyBouc\Controller\AdminController::addBookAction")->bind('adminaddbook');

$app->match('/admin/book/delete/{id}', "LazyBouc\Controller\AdminController::deleteBookAction")->bind('adminbookdelete');

$app->match('/admin/book/edit/{id}', "LazyBouc\Controller\AdminController::editBookAction")->bind('adminbookedit');