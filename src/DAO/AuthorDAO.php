<?php

namespace LazyBouc\DAO;

use LazyBouc\Domain\Author;

class AuthorDAO extends DAO
{
	/**
     * Return a list of all Authors, sort alphabetically.
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