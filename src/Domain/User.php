<?php

namespace LazyBouc\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    /**
     * User id.
     *
     * @var integer
     */
    private $id;

    /**
     * Login/Username.
     *
     * @var string
     */
    private $login;
	
	/**
     * Firstname.
     *
     * @var string
     */
    private $firstname;
	
	/**
     * Lastname.
     *
     * @var string
     */
    private $lastname;
	
	/**
     * Mail address.
     *
     * @var string
     */
    private $mail;

    /**
     * User password.
     *
     * @var string
     */
    private $password;

    /**
     * Salt that was originally used to encode the password.
     *
     * @var string
     */
    private $salt;

    /**
     * Role.
     * Values : ROLE_USER or ROLE_ADMIN.
     *
     * @var string
     */
    private $role;
	
	/**
     * Shopping cart.
     *
     * @var LazyBouc\Domain\Book
     */
    private $shoppingCart;
	
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

	 /**
     * @inheritDoc
     */
    public function getUsername() {
        return $this->login;
    }

    public function setUsername($username) {
        $this->login = $username;
    }
	
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
	
    public function getLastname() {
        return $this->lastname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
	
    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }
	
	public function getShoppingCart() {
        return $this->shoppingCart;
    }

    public function setShoppingCart($shoppingCart) {
        $this->shoppingCart = $shoppingCart;
    }
	
    /**
     * @inheritDoc
     */
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array($this->getRole());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials() {
        // Nothing to do here
    }
	
	public function __toString(){
		return $this->getFirstname()." ".$this->getLastname();
	}
}
