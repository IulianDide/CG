<?php
require_once __DIR__ . '/Deck.php';
class Player {
	
	protected $name;
	
	protected $deck;
	
	public function __construct($name) {
		$this->name = $name;
		return $this;
	}
	
	public function getName() {
		return $this->name;
	}
	
}