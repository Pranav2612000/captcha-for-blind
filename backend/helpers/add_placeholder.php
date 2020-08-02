<?php
require '../config.php';
session_start();

function put_placeholder() {
  echo ("<script src=" . $GLOBALS['base_url'] . "js/togglecaptcha.js/><div class='ca-placeholder-body' onclick='toggleCaptcha()'> Press to view captcha </div>");
  return;
}
?>
