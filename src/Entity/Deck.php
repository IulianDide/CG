<?php
require_once __DIR__ . '/Card.php';

class Deck extends ArrayIterator {
	
	public function __toString() {
		$toString = '';
		for ( $this->rewind(); $this->valid(); $this->next() ) {
			$toString .= $this->current()->__toString();
		}
		
		return $toString;
	}
}