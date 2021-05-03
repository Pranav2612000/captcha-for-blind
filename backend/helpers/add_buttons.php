<?php
require '../config.php';
function add_buttons() {
  $str = " <div class='ca-button-group'>
      <button id='audio' class='ca-button ca-btn-helper' onclick='getAudio(event)'>
        <img class='ca-btn-icon ca-button' src='" . $GLOBALS['base_url'] . "assets/images/audio.png'/>
      </button>
      <button id='change_captcha' class='ca-button ca-btn-icon' onclick='switchCaptcha(event)'>
        <img id='change-captcha-img' class='ca-btn-icon ca-ignore ca-button' src='" . $GLOBALS['base_url'] . "assets/images/switch.png'/>
      </button>
      <button class='ca-button ca-btn-helper' id='switch_lang' onclick='myFunction(event)'>
        <img id='ca-switch-lang-icon' onclick='myFunction(event)' class='ca-btn-icon ca-button' src='" . $GLOBALS['base_url'] . "assets/images/translate.jpeg'/>
        <div id='myDropdown' class='dropdown-content'>
          <span onclick='changeLanguage(event, \"en\",`" . $_SESSION['captcha_type'] . "`)' class='lang-option ca-ignore'>English</span>
          <span onclick='changeLanguage(event, \"hi\",`" . $_SESSION['captcha_type'] . "`)' class='lang-option ca-ignore'>Hindi</span>
          <span onclick='changeLanguage(event, \"pa\",`" . $_SESSION['captcha_type'] . "`)' class='lang-option ca-ignore'>Punjabi</span>
          <span onclick='changeLanguage(event, \"gu\",`" . $_SESSION['captcha_type'] . "`)' class='lang-option ca-ignore'>Gujrati</span>
          <span onclick='changeLanguage(event, \"bn\",`" . $_SESSION['captcha_type'] . "`)' class='lang-option ca-ignore'>Bengali</span>
          <span onclick='changeLanguage(event, \"mr\",`" . $_SESSION['captcha_type'] . "`)' class='lang-option ca-ignore'>Marathi</span>
        </div>
      </button>
    </div> ";
  //echo $str;
  return $str;
}
// 
//    <button class='ca-button' type='submit' name='register' id='submit' value='Check' >" . $_SESSION['check'] . "</button>
?>
