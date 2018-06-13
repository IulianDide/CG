<?php
require_once __DIR__ . '/Entity/Player.php';
require_once __DIR__ . '/Logger/Logger.php';

class App {
	
	/** Players[] $players */
	public $players = [];
	
	/** Logger $log*/
	protected $logger;
	
	/** Deck $deck */
	protected $deck;
	
	const CARD_NUMBER_TO_DEAL = 7;
	
	public function __construct(array $players) {
		
		//initialise the logger
		$this->logger = new Logger();
		
		
		//get the players in the game
		$this->generatePlayers($players);
		
		//generate the deck
		$this->generateDeck();
		
		return $this;
	}
	
	private function generatePlayers(array $players) {
		foreach ($players as $player) {
			$player = new Player($player);
			$this->players[] = $player;
			$this->logger->logMessage('Player ' . $player->getName() . ' has entered the game!');
		}
		
	}
	
	public function generateDeck() {
		$this->deck = new Deck();
		for ($i = Card::$minCardNumer; $i<= Card::$maxCardNumer; $i++) {
			foreach (Card::$colourData as $type => $colour) {
				$this->deck->append(new Card($i, $type));
			}
		}
	}
	
	
	public function play() {
		
		$this->dealCards();
		
		$this->logger->printLogs();
	}
	
	protected function dealCards() {
		
		foreach($this->players as $player) {
			for ($i=1; $i <= self::CARD_NUMBER_TO_DEAL; $i++) {
				$player->takeCard($this->deck->current());
				$this->deck->next();
			}
			
			$this->loggger->logMessage('Freek has been dealt:'.$deck);
		}
		
	}
	
}