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
	
	public function setAuthorDAO(AuthorDAO $authorDAO) {
        $this->authorDAO = $authorDAO;
    }

    public function setGenreDAO(GenreDAO $genreDAO) {
        $this->genreDAO = $genreDAO;
    }
	
	/**
     * Return a list of all Books, sorted by publication.
     *
     * @return array A list of all Books.
     */
    public function findAll() {
        $sql = "select * from t_book order by bk_year desc";
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
     * Returns a book matching the supplied id.
     *
     * @param integer $id the book id.
     *
     * @return \LazyBouc\Domain\Book throws an exception if no matching book is found
     */
    public function find($id) {
        $sql = "select * from t_book where bk_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No book matching id " . $id);
    }
	
	/**
     * Return a list of all Books depending on an Author.
     *
     * @return array A list of all Books.
     */
    public function findAllByAuthor($authorId) {		
        $sql = "select bk_id, bk_long_summary, bk_short_summary, bk_title, bk_price, bk_year, bk_image, aut_id, gen_id from t_book b where aut_id=? order by bk_year desc";
        $result = $this->getDb()->fetchAll($sql,array($authorId));

        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['bk_id'];
            $books[$bookId] = $this->buildDomainObject($row);
			//add genre
			$genre = $this->genreDAO->findByBook($bookId);
			$books[$bookId]->setGenre($genre);
        }
        return $books;
    }
	
	/**
     * Return a list of all Books, sort alphabetically.
     *
     * @return array A list of all Books.
     */
    public function findAllByGenre($genreID) {
        $sql = "select * from t_book where gen_id=? order by bk_year desc";
        $result = $this->getDb()->fetchAll($sql, array($genreID));

        // Convert query result to an array of domain objects
        $books = array();
        foreach ($result as $row) {
            $bookId = $row['bk_id'];
			$books[$bookId] = $this->buildDomainObject($row);
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
		$book->setImage($row['bk_image']);
		$book->setGenre($this->genreDAO->find($row['gen_id']));
		$book->setAuthor($this->authorDAO->find($row['aut_id']));
		
        return $book;
    }
	
	/**
     * Saves a book into the database.
     *
     * @param \LazyBouc\Domain\Book $book The book to save
     */
    public function save(Book $book) {
        $bookData = array(
            'bk_image' => $book->getImage(),
			'bk_long_summary' => $book->getLongSummary(),
			'bk_short_summary' => $book->getShortSummary(),
			'bk_price' => $book->getPrice(),
            'bk_title' => $book->getTitle(),
            'bk_year' => $book->getYear(),
            'gen_id' => $book->getGenre()->getId(),
			'aut_id' => $book->getAuthor()->getId()
		);
		
        if ($book->getId()){
            // The book has already been saved : update it
            $this->getDb()->update('t_book', $bookData, array('bk_id' => $book->getId()));
		} else {
            // The book has never been saved : insert it
            $this->getDb()->insert('t_book', $bookData);
			
            // Get the id of the newly created book and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $book->setId($id);
        }
    }
	
	/**
     * Removes a book from the database.
     *
     * @param @param integer $id The book id.
     */
    public function delete($id) {
        // Delete the user
        $this->getDb()->delete('t_book', array('bk_id' => $id));
    }
}