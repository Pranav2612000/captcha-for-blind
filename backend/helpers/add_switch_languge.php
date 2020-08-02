<?php
function add_switch_language_elem($captcha_type) {
  echo "
    <div>
      <select name='lang' id='lang' onchange='changeLanguage(event,\"" . $captcha_type . "\")'>
        <option value='en' >English</option>
        <option value='hi'>Hindi</option>
        <option value='gu'>Gujarati</option>
        <option value='mr'>Marathi</option>
        <option value='bn'>Bengali</option>
        <option value='pa'>Punjabi</option> 
      </select>
    </div>
    ";
  return;
}
?>
