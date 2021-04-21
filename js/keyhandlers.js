document.addEventListener("keydown", function (e) {
  function rand(min, max) {
    let randomNum = Math.random() * (max - min) + min;
    return Math.round(randomNum);
  }

  if (isAInput(e.target)) {
    return;
  }

  /*if(validation_com == true) {
    return;
  }*/

  if (window.event.keyCode == 74) {
    //J - open captcha
    window.event.preventDefault();
    console.log("j");
    toggleCaptcha(e);
  }

  if (ended == true) {
    return;
  }

  switch (window.event.keyCode) {
    case 50: //2 - swich que
      window.event.preventDefault();
      console.log("s");
      var x = rand(1, 2);
      if (x == 1) {
        switchCaptcha(window.event, "gesture");
      } else if (x == 2) {
        switchCaptcha(window.event, "pressure");
      }
      break;

    case 51: //3 - change lang
      window.event.preventDefault();
      console.log("l");
      play_change_lang();
      break;

    case 70: //f - repeat ins
      window.event.preventDefault();
      console.log("r");
      play_ins();
      break;

    case 49: //1 - audio
      window.event.preventDefault();
      console.log("a");
      getAudio(window.event);
      break;

    case 52: //4 - eng
      window.event.preventDefault();
      var x = rand(1, 2);
      if (x == 1) {
        type = "gesture";
      } else {
        type = "pressure";
      }
      changeLanguage(e, "en", type);
      break;

    case 53: //5 - hindi
      window.event.preventDefault();
      //var cap_type = '<?php echo $_SESSION["captcha_type"]; ?>';
      //console.log(cap_type);
      var x = rand(1, 2);
      if (x == 1) {
        type = "gesture";
      } else {
        type = "pressure";
      }
      changeLanguage(e, "hi", type);
      break;

    case 55: //7 - guj
      window.event.preventDefault();
      var x = rand(1, 2);
      if (x == 1) {
        type = "gesture";
      } else {
        type = "pressure";
      }
      changeLanguage(e, "gu", type);
      break;

    case 54: //6 - marathi
      window.event.preventDefault();
      var x = rand(1, 2);
      if (x == 1) {
        type = "gesture";
      } else {
        type = "pressure";
      }
      changeLanguage(e, "mr", type);
      break;

    case 55: //8 - panjabi
      window.event.preventDefault();
      var x = rand(1, 2);
      if (x == 1) {
        type = "gesture";
      } else {
        type = "pressure";
      }
      changeLanguage(e, "pa", type);
      break;

    case 83: // s for stop
      window.event.preventDefault();
      audio.paused();
      audio_l.paused();
      break;
  }
});
