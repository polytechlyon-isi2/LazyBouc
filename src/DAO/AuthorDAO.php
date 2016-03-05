<?php

namespace LazyBouc\DAO;

use LazyBouc\Domain\Author;

class AuthorDAO extends DAO
{
	
	/*
	* @var \LazyBouc\DAO\BookDAO
	*/
	private $bookDAO;
	
	public function setBookDAO(BookDAO $bookDAO) {
        $this->bookDAO = $bookDAO;
    }
	
	/**
     * Return a list of all Authors, sorted alphabetically.
     *
     * @return array A list of all Authors.
     */
    public function findAll() {
        $sql = "select * from t_author order by aut_lastname";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $authors = array();
        foreach ($result as $row) {
            $authorId = $row['aut_id'];
            $authors[$authorId] = $this->buildDomainObject($row);
			// ajouter les livres aux auteurs
        }
        return $authors;
    }
	
	/**
     * Return a list of all Authors depending on an Author, sorted alphabetically.
     *
     * @return array A list of all Authors.
     */
    public function findAllByBook($bookId) {		
        $sql = "select * from t_author a join t_aut_bk_write abw on a.aut_id=abw.at_id where abw.bk_id=? order by aut_lastname";
        $result = $this->getDb()->fetchAll($sql,array($bookId));

        // Convert query result to an array of domain objects
        $authors = array();
        foreach ($result as $row) {
            $authorId = $row['aut_id'];
            $authors[$authorId] = $this->buildDomainObject($row);
			// ajouter les livres aux auteurs
        }
        return $authors;
    }
	
	/**
     * Creates an Author object based on a DB row.
     *
     * @param array $row The DB row containing Author data.
     * @return \LazyBouc\Domain\Author
     */
    protected function buildDomainObject($row) {
        $author = new Author();
        $author->setId($row['aut_id']);
        $author->setFirstname($row['aut_firstname']);
        $author->setLastname($row['aut_lastname']);
		$author->setBirth($row['aut_birth']);
        return $author;
    }
}