<?php

namespace LazyBouc\DAO;

use LazyBouc\Domain\Book;

class BookDAO extends DAO
{
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
		//.........
        return $book;
    }
}