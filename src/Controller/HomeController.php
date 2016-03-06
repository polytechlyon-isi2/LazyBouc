<?php

namespace LazyBouc\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class HomeController {

    /**
     * Home page controller.
     *
     * @param Application $app Silex application
     */
	public function indexAction(Application $app) {
		$genres = $app['dao.genre']->findAll();
		return $app['twig']->render('index.html.twig', array('genres' => $genres));
	}

	/**
    * View by genre controller.
    *
    * @param integer $id Genre id
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
	public function genreAction($id, Request $request, Application $app) {
		$genres = $app['dao.genre']->findAll();
		$genre = $app['dao.genre']->find($id);
		$books = $app['dao.book']->findAllByGenre($id);
		return $app['twig']->render('genre.html.twig', array('genres' => $genres, 'books' => $books, 'currentGenre' => $genre));
	}
	
	/**
     * Book details controller.
     *
     * @param integer $id Genre id
     * @param Request $request Incoming request
     * @param Application $app Silex application
     */
	public function bookAction($id, Request $request, Application $app) {
		$genres = $app['dao.genre']->findAll();
		$book = $app['dao.book']->find($id);
		$authors = $app['dao.author']->findAllByBook($id);
		return $app['twig']->render('book.html.twig', array(
			'genres' 	=> $genres, 
			'book' 		=> $book,
			'authors'	=> $authors
		));
	}
	 
	/**
    * Login controller.
    *
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
	public function loginAction(Request $request, Application $app) {
	$genres = $app['dao.genre']->findAll();
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
		'genres'        => $genres,
    ));
}
    
}
