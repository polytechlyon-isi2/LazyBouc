<?php

namespace LazyBouc\Utils;

class Utils 
{
	/**
    * Static function to return a book key from the shoppingCart.
    *
    * @param $book to search in cart
    * @param $cart containing books
    */
	public static function searchKeyBook($book,$cart){
		foreach($cart as $k => $v){
			if($v['book'] == $book)
				return $k;
		}
		return false;
	}
	
	/**
    * Static function to return the size of the shoppingCart.
    *
    * @param $cart containing books
    */
	public static function cartSize($cart){
		$s = 0;
		foreach($cart as $k => $v){
			$s += $v['quantity'];
		}
		return $s;
	}
	
	/**
    * Static function to return the total amount of the shoppingCart.
    *
    * @param $cart containing books
    */
	public static function totalCartPrice($cart){
		$s = 0;
		foreach($cart as $k => $v){
			$s += $v['book']->getPrice()*$v['quantity'];
		}
		return $s;
	}
}
