<?php
session_start();
require '../config.php';

function lang_translate($lang) {
    if($lang == 'hi'){
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/Hindi_pop_up_instruction.mp3></audio>";
        echo $player1;
        return;
    }
    else if($lang == 'gu'){
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins.mp3></audio>";
        echo $player1;
        return;
    }
    else if($lang == 'mr'){
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins1.mp3></audio>";
        echo $player1;
        return;
    }
    else if($lang == 'pa'){
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins2.mp3></audio>";
        echo $player1;
        return;
    }
    else {
        $player1= "<audio autoplay><source src=". $GLOBALS['base_url'] . "assets/sounds/guides/ins3.mp3></audio>";
        echo $player1;
        return;
    }
}



?>
