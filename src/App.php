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
	
	/** Card $topCard */
	protected $topCard;
	
	/** Player|null $winner */
	protected $winner = null;
	
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
	
	
	/**
	* @param array with player data
	*/
	private function generatePlayers(array $players) {
		foreach ($players as $player) {
			$player = new Player($player);
			$this->players[] = $player;
			$this->logger->logMessage('Player ' . $player->getName() . ' has entered the game!');
		}
		
		return true;
	}
	
	public function generateDeck() {
		$cardsArray = [];
		
		for ($i = Card::$minCardNumer; $i<= Card::$maxCardNumer; $i++) {
			foreach (Card::$colourData as $type => $colour) {
				$cardsArray[] = new Card($i, $type);
			}
		}
		shuffle($cardsArray);
		
		$this->deck = new Deck($cardsArray);
		
		return true;
	}
	
	
	public function play() {
		
		$this->dealCards();
		
		$this->playRounds();
		
		$this->logger->printLogs();
	}
	
	protected function dealCards() {

		for($currentPlayer = 0; $currentPlayer < count($this->players); $currentPlayer++) {
			for ($i=1; $i <= self::CARD_NUMBER_TO_DEAL; $i++) {
				$this->players[$currentPlayer]->takeCard($this->deck->current());
				$this->deck->next();
			}
			
			$this->logger->logMessage($this->players[$currentPlayer]->getName() . ' has been dealt:' . $this->players[$currentPlayer]->getDeck());
		}
		
		//set the top card
		$this->topCard = $this->deck->current();
		$this->logger->logMessage("Top card is:" . $this->topCard);
		$this->deck->next();
		
	}
	
	public function playRounds()  {
		
		do {
			
			for($currentPlayer = 0; $currentPlayer < count($this->players); $currentPlayer++) {
				$matchingCard = $this->players[$currentPlayer]->hasMatchingCard($this->topCard);
				
				if ($matchingCard) {
					$this->topCard = $matchingCard;
					if ($this->players[$currentPlayer]->isWinner()) {
						$this->winner = $this->players[$currentPlayer];
						$this->logger->logMessage($this->players[$currentPlayer]->getName() . '  plays ' . $matchingCard);
						$this->logger->logMessage($this->players[$currentPlayer]->getName() . ' has won.');
						break;
					}
					$this->logger->logMessage($this->players[$currentPlayer]->getName() . '  plays ' . $matchingCard);
				} else {
					$this->players[$currentPlayer]->takeCard($this->deck->current());
					$this->logger->logMessage($this->players[$currentPlayer]->getName() . '  does not have a suitable card, taking from deck:' . $this->deck->current());
					if ($this->deck->valid()) {
						$this->deck->next();
					}
				}
			}
			
		} while (is_null($this->winner));
		
		return true;
	}
	
}