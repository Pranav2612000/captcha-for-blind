<?php
require '../config.php';
function add_buttons() {
  echo "
    <button id='audio' class='ca-button' onclick='getAudio(event)'>
      <img class='ca-btn-icon ca-button' src='" . $GLOBALS['base_url'] . "assets/images/audio.png'/>
    </button>
    <button class='ca-button' type='submit' name='register' id='submit' value='Check' >" . $_SESSION['check'] . "</button>
    <button class='ca-button' id='switch_lang' onclick='changeLanguage(event, 'pressure')'>
      <img class='ca-btn-icon ca-button' src='" . $GLOBALS['base_url'] . "assets/images/translate.jpeg'/>
    </button>
  ";
}
?>
