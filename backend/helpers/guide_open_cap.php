<?php
session_start();
require '../config.php';

function guide_to_open_captcha() {
    $player1= "<audio ><source src=". $GLOBALS['base_url'] . "assets/audio/guides/open_cap.mp3></audio>";
	  echo $player1;
    return;
}



?>
