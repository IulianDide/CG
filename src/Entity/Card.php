<?php

class Card {
	
	protected $number;
	
	protected $symbol;
	
	public static $colourData = [
		'hearts' 	=> 1,	//red
		'diams' 	=> 1, 	//red
		'clubs'		=> 0,	//black
		'spades'	=> 0	//black
	];
	
	public static $minCardNumer = 2;	//Considering 11 as ACE
	public static $maxCardNumer = 14; 	//
	
	public static $cardNumbersMapping = [
		'11' => 'Ace',
		'12' => 'Jack',
		'13' => 'Queen',
		'14' => 'King',
	];
	
	
	
	public function __construct($number, $symbol) {
		$this->number = $number;
		$this->symbol = $symbol;
		
		return $this;
	}
	
	public function getNumber() {
		return $this->number;
	}
	
	public function getSymbol() {
		return $this->symbol;
	}
	
	public function getColour() {
		return $this::$colourData[$this->symbol];
	}
	
	public function __toString() {
		$name = '&'.$this->symbol.';';
		$name .= (isset(self::$cardNumbersMapping[$this->number])) ? self::$cardNumbersMapping[$this->number] : $this->number;
		
		return $name;
	}
}