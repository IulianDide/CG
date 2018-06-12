<?php

class Logger {
	
	protected $logs = [];
	
	public function __construct() {
		//do nothing
		return $this;
	}
	
	public function logMessage($message) {
		$this->logs[] = $message;
	}
	
	// just in case we want to output it in multiple places/formats
	public function getLogs() {
		foreach ($this->logs as $logMessage) {
			yield $logMessage;
		}
	}
	
	public function printLogs() {
		$output = "<ul>";
		foreach ($this->getLogs() as $logMessage) {
			echo '<li>'.$logMessage.'</li>';
		}
		$output = "</ul>";
		print($output);
	}
}