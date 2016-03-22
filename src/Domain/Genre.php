<?php

namespace LazyBouc\Domain;

class Genre
{
	
	/*
	* Genre id.
	*
	* @var integer
	*/
	private $id;
	
	/*
	* Book label.
	*
	* @var string
	*/
	private $label;
	
	/*
	* Book short label.
	*
	* @var string
	*/
	private $shortLabel;
	
	
	public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
	public function getLabel() {
        return $this->label;
    }

    public function setLabel($label) {
        $this->label = $label;
    }
	public function getShortLabel() {
        return $this->shortLabel;
    }

    public function setShortLabel($shortLabel) {
        $this->shortLabel = $shortLabel;
    }
	
	public function __toString(){
		return $this->getLabel();
	}
	
}