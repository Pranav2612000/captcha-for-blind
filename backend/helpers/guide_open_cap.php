<?php
session_start();
require '../config.php';

function guide_to_open_captcha() {
    $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guide/cap_open.mp3></audio>";
	echo $player1;
    return;
}



?>