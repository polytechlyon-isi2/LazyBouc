<?php

namespace LazyBouc\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use LazyBouc\Domain\User;
use LazyBouc\Form\Type\UserType;
use LazyBouc\Utils\Utils;

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
		return $app['twig']->render('book.html.twig', array(
			'genres' 	=> $genres, 
			'book' 		=> $book
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
	
	/**
    * Add to cart controller.
    *
	* @param integer $id book id
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
	public function addCartAction($id, Request $request, Application $app) {
		$cart = $app['session']->get('shoppingCart');
		$book = $app['dao.book']->find($id);
		$key = $book->getId();
		if(!empty($cart) && !empty($cart[$key])){
			$app['session']->getFlashBag()->add('error', 'Ce livre est déjà dans votre panier.');
		}
		else{
			$cart[$key]=$book;
			$app['session']->getFlashBag()->add('success', 'Le livre a bien été ajouté au panier.');
		}
		$app['session']->set('shoppingCart', $cart);
		$app['session']->set('shoppingCartSize', count($cart));
		$prices = array_map(function($b) {
			return is_object($b) ? $b->getPrice() : $b['price'];
		}, $cart);
		$app['session']->set('shoppingCartAmount', array_sum($prices));
		return $this->bookAction($id, $request, $app);
	}
	
	/**
    * Delete in cart controller.
    *
	* @param integer $id book id
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
	public function deleteCartAction($id, Request $request, Application $app) {
		$cart = $app['session']->get('shoppingCart');
		if(empty($cart[$id])){
			$app['session']->getFlashBag()->add('error', 'Le livre ne se trouve pas dans le panier.');
		}else{
			unset($cart[$id]);
			$app['session']->set('shoppingCart', $cart);
			$app['session']->getFlashBag()->add('success', 'Le livre a bien été supprimé du panier.');
		}		
		$app['session']->set('shoppingCartSize', count($cart));
		$prices = array_map(function($b) {
			return is_object($b) ? $b->getPrice() : $b['price'];
		}, $cart);
		$app['session']->set('shoppingCartAmount', array_sum($prices));
		return $this->cartAction($request,$app);
	}
	
	/**
    * Cart controller.
    *
    * @param Request $request Incoming request
    * @param Application $app Silex application
    */
	public function cartAction(Request $request, Application $app) {
		$genres = $app['dao.genre']->findAll();
		return $app['twig']->render('cart.html.twig', array(
			'genres' 	=> $genres, 
		));
	}
	
	
}