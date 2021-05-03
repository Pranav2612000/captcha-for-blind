<?php
require '../config.php';
session_start();

function put_placeholder() {
  echo ("
        <script src=" . $GLOBALS['base_url'] . "js/togglecaptcha.js/>
        <form>
          <button class='main-btn' onclick='toggleCaptcha(event)'>
          </button>
          <div class='ca-placeholder-body ca-button' onclick='toggleCaptcha(event)'>
           <span id='cap_open'>" . add_buttons() . "</span>
            <span id='cap_closed' class='ca-ignore'>
              <span id='view-text' class='ca-button'>
                  Press to view captcha
              </span>
            </span>
          </div>
        </form>
      ");
  return;
}
?>
