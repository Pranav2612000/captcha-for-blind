<?php
require '../config.php';
function add_buttons() {
  $str = " <div class='ca-button-group'>
      <button id='audio' class='ca-button' onclick='getAudio(event)'>
        <img class='ca-btn-icon ca-button' src='" . $GLOBALS['base_url'] . "assets/images/audio.png'/>
      </button>

      <button id='change_captcha' class='ca-button' onclick='switchCaptcha(event)'>
        <img class='ca-btn-icon ca-button' src='" . $GLOBALS['base_url'] . "assets/images/switch.png'/>
      </button>

      <button class='ca-button' id='switch_lang' onclick='myFunction(event)'>
        <img class='ca-btn-icon ca-button' src='" . $GLOBALS['base_url'] . "assets/images/translate.jpeg'/>
        <div id='myDropdown' class='dropdown-content'>
          <a href='#' class='ca-ignore'>Link 1</a>
          <a href='#' class='ca-ignore'>Link 2</a>
          <a href='#' class='ca-ignore'>Link 3</a>
        </div>
      </button>
    </div> ";
  //echo $str;
  return $str;
}
// 
//    <button class='ca-button' type='submit' name='register' id='submit' value='Check' >" . $_SESSION['check'] . "</button>
?>
