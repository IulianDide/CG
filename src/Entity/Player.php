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
	
	public function getDeck() {
		return $this->deck;
	}
	
	public function takeCard(Card $card) {
		$this->deck->append($card);
		return $this;
	}
	
	public function hasMatchingCard(Card $card) {
		foreach ($this->deck as $offset => $playerCard) {
			if ($playerCard->getColour() == $card->getColour() ||
				$playerCard->getNumber() == $card->getNumber()) {
					$this->deck->offsetUnset($offset);
					return $playerCard;
				}
		}
		
		return null;
	}
	
	public function isWinner() {
		return !$this->deck->count();
	}
	
}