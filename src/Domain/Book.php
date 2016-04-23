<?php

namespace LazyBouc\Domain;

class Book
{
	
	/*
	* Book id.
	*
	* @var integer
	*/
	private $id;
	
	/*
	* Book long summary.
	*
	* @var string
	*/
	private $longSummary;
	
	/*
	* Book short summary.
	*
	* @var string
	*/
	private $shortSummary;
	
	/*
	* Book price.
	*
	* @var float
	*/
	private $price;
	
	/*
	* Book title.
	*
	* @var string
	*/
	private $title;
	
	/*
	* Book year of publication.
	*
	* @var integer
	*/
	private $year;
	
	/*
	* Image for the book.
	*
	* @var string
	*/
	private $image;
	
	/*
	* Associated genre.
	*
	* @var LazyBouc\Domain\Genre
	*/
	private $genre;
	
	/*
	* Associated author.
	*
	* @var LazyBouc\Domain\Author
	*/
	private $author;
	
	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
	public function getLongSummary() {
        return $this->longSummary;
    }

    public function setLongSummary($longSummary) {
        $this->longSummary = $longSummary;
    }
	public function getShortSummary() {
        return $this->shortSummary;
    }

    public function setShortSummary($shortSummary) {
        $this->shortSummary = $shortSummary;
    }
	
	public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
	
	public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }
	
	public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }
	
	public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
	
	public function getGenre() {
        return $this->genre;
    }

    public function setGenre(Genre $genre) {
        $this->genre = $genre;
    }
	
	public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(Author $author) {
        $this->author = $author;
    }
	
}