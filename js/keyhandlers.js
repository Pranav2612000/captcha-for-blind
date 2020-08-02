
document.addEventListener("keydown", function(e) {
  if(isAInput(e.target)) {
    return;
  }
  switch (window.event.keyCode) {
    case 79:
      window.event.preventDefault();
      console.log("w");
      toggleCaptcha();
      break;  
    case 87: //w
    window.event.preventDefault();
      console.log("w");
      $("#captcha_code").focus();
      break;
    case 89: //y
    window.event.preventDefault();
    console.log("y");
      $("#submit").click();
      break;
    case 76: //l
    window.event.preventDefault();
    console.log("l");
      $("#switch_lang").click();
      break;

    case 73: //i
    window.event.preventDefault();
    console.log("i");
      $('#voice_inp').click();
      break;
    case 65: //a
    window.event.preventDefault();
    console.log("a");
      $('#audio').click();
      break;

  }
});
