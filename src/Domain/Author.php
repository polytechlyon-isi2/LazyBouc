<?php

namespace LazyBouc\Domain;

class Author
{
	/*
	* Author id.
	*
	* @var integer
	*/
	private $id;
	
	/*
	* Author firstname.
	*
	* @var string
	*/
	private $firstname;
	
	/*
	* Author lastname.
	*
	* @var string
	*/
	private $lastname;
	
	/*
	* Author birth.
	*
	* @var integer
	*/
	private $birth;
	
	/*
	* Written books.
	*
	* @var LazyBooks\Domain\Books
	*/
	private $books;
	
	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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
	
	public function getBirth() {
        return $this->birth;
    }

    public function setBirth($birth) {
        $this->birth = $birth;
    }
	
	public function getBooks() {
        return $this->books;
    }

    public function setBooks($books) {
        $this->books = $books;
    }
	
}
