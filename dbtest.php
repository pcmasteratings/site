<?php
require_once("res/include.php");

$game = new Games();

$game->setTitle("TEST");
$game->save();

?>