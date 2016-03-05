<?php

use Symfony\Component\HttpFoundation\Request;
use LazyBouc\Domain\Comment;
use LazyBouc\Form\Type\CommentType;

// Home page
$app->get('/', function () use ($app) {
	$genres = $app['dao.genre']->findAll();
    return $app['twig']->render('index.html.twig', array('genres' => $genres));
})->bind('home');
$app->match('/genre/{id}', function ($id, Request $request) use ($app) {
	$genres = $app['dao.genre']->findAll();
	$genre = $app['dao.genre']->find($id);
	$books = $app['dao.book']->findAllByGenre($id);
	return $app['twig']->render('genre.html.twig', array('genres' => $genres, 'books' => $books, 'currentGenre' => $genre));
})->bind('genre');
$app->match('/book/{id}', function ($id, Request $request) use ($app) {
	$genres = $app['dao.genre']->findAll();
	$book = $app['dao.book']->find($id);
	return $app['twig']->render('book.html.twig', array('genres' => $genres, 'book' => $book));
})->bind('book');
