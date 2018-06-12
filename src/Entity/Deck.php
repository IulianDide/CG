<?php
require_once __DIR__ . '/Card.php';

class Deck {
	
	public $cards = [];
	
	public function __construct() {
		return $this;
	}
	
	public function push(Card $card) {
		$this->cards[] = $card;
	}
	
}