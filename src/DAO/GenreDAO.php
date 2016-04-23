<?php

namespace LazyBouc\DAO;

use LazyBouc\Domain\Genre;

class GenreDAO extends DAO
{
	/**
     * Return a list of all Genres, sorted alphabetically.
     *
     * @return array A list of all Genres.
     */
    public function findAll() {
        $sql = "select * from t_genre order by gen_label";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $genres = array();
        foreach ($result as $row) {
            $genreId = $row['gen_id'];
            $genres[$genreId] = $this->buildDomainObject($row);
        }
        return $genres;
    }
	
	/**
     * Returns a genre matching the supplied id.
     *
     * @param integer $id the genre id.
     *
     * @return \LazyBouc\Domain\Genre throws an exception if no matching genre is found
     */
    public function find($id) {
        $sql = "select * from t_genre where gen_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No genre matching id " . $id);
    }
	
	/**
     * Creates an Genre object based on a DB row.
     *
     * @param array $row The DB row containing Genre data.
     * @return \LazyBouc\Domain\Genre
     */
    protected function buildDomainObject($row) {
        $genre = new Genre();
        $genre->setId($row['gen_id']);
        $genre->setLabel($row['gen_label']);
        $genre->setShortLabel($row['gen_short_lbl']);
        return $genre;
    }
}