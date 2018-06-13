<?php
require_once __DIR__ . '/Card.php';

class Deck extends ArrayIterator {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function __toString() {
		return var_dump($this);
	}
}