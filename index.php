<?php

//get configs and the app
require_once __DIR__ . '/src/Config/config.php';
require_once __DIR__ . '/src/App.php';

//initlaise app with players
$cardGame = new App($config['players']);
 
//play the game
$cardGame->play();
 
 