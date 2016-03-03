<?php

namespace LazyBouc\DAO;

use LazyBouc\Domain\Book;

class BookDAO extends DAO
{
	/*
	* @var \LazyBouc\DAO\AuthorDAO
	*/
	private $authorDAO;
	
	/*
	* @var \LazyBouc\DAO\GenreDAO
	*/
	private $genreDAO;
	
	public function setAuthorsDAO(AuthorDAO $authorDAO) {
        $this->authorDAO = $authorDAO;
    }

    public function setGenreDAO(GenreDAO $genreDAO) {
        $this->genreDAO = $genreDAO;
    }
	
	/**
     * Return a list of all Authors, sort alphabetically.
     *
     * @return array A list of all Authors.
     */
    public function findAll() {
        $sql = "select * from t_book order by year desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['bk_id'];
            $books[$bookId] = $this->buildDomainObject($row);
        }
        return $books;
    }
	
	/**
     * Return a list of all Authors, sort alphabetically.
     *
     * @return array A list of all Authors.
     */
    public function findAllByGenre($genreID) {
		// The associated genre is retrieved only once
		$genre = $this->genreDAO->find($genreID);
		
        $sql = "select * from t_book where gen_id=? order by year desc";
        $result = $this->getDb()->fetchAll($sql, array($articleID));

        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['bk_id'];
			
			// The associated authors is retrieved
			$authors = $this->authorDAO->findAllByBook($bookId);
			
            $book = $this->buildDomainObject($row);
			$book->setGenre($genre);
			$book->setAuthors($authors);
			$books[$bookId] = $book;
        }
        return $books;
    }
	
	/**
     * Creates a Book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \LazyBouc\Domain\Book
     */
    protected function buildDomainObject($row) {
        $book = new Book();
        $book->setId($row['bk_id']);
        $book->setLongSummary($row['bk_long_summary']);
        $book->setShortSummary($row['bk_short_summary']);
		$book->setTitle($row['bk_title']);
		$book->setPrice($row['bk_price']);
		$book->setYear($row['bk_year']);
		
        return $book;
    }
}