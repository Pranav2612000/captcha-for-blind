<?php
require '../config.php';
session_start();

function put_placeholder() {
  echo ("
        <script src=" . $GLOBALS['base_url'] . "js/togglecaptcha.js/>
        <div class='ca-placeholder-body ca-button' onclick='toggleCaptcha()'>
         <span id='cap_open'>" . add_buttons() . "</span>
          <span id='cap_closed'>
            <span id='view-text' class='ca-button'>
                Press to view captcha
            </span>
          </span>
        </div>
      ");
  return;
}
?>
