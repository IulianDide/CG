<?php
require_once __DIR__ . '/Deck.php';
class Player {
	
	protected $name;
	
	protected $deck;
	
	public function __construct($name) {
		$this->name = $name;
		$this->deck = new Deck();
		return $this;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function takeCard(Card $card) {
		$this->deck->append($card);
		return $this;
	}
	
}