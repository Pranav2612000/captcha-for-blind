
document.addEventListener("keydown", function(e) {
  function rand(min, max) {
    let randomNum = Math.random() * (max - min) + min;
    return Math.round(randomNum);
 }

  if(isAInput(e.target)) {
    return;
  }

  /*if(validation_com == true) {
    return;
  }*/

  if(window.event.keyCode == 79) {
      window.event.preventDefault();
      console.log("o");
      toggleCaptcha(e);
  }
  if(ended == true) {
    return;
  }
  
  switch (window.event.keyCode) {
    case 83: //s - swich que 
      window.event.preventDefault();
      console.log("s");
      var x = rand(1, 2);
      if(x == 1){
        switchCaptcha(window.event, "gesture");
      }
      else if(x == 2){
        switchCaptcha(window.event, "pressure");
      }
      break;  
    case 76: //l - change lang
      window.event.preventDefault();
      console.log("l");
      play_change_lang();
      break;

    case 70: //f - repeat ins 
      window.event.preventDefault();
      console.log("r");
      play_ins();
      break;

    case 65: //a - audio 
      window.event.preventDefault();
      console.log("a");
      getAudio(window.event);
      break;


    
    case 69: //e - eng
      window.event.preventDefault();
      var x = rand(1, 2);
      if(x == 1){
        type = "gesture"
      }
      else{
        type = "pressure"
      }
      changeLanguage_press(e,type, 'en')
      break;
      
    case 72: //h - hindi
      window.event.preventDefault();
      var x = rand(1, 2);
      if(x == 1){
        type = "gesture"
      }
      else{
        type = "pressure"
      }
      changeLanguage_press(e,type, 'hi')
      break;
    
    case 71: //g - guj
      window.event.preventDefault();
      var x = rand(1, 2);
      if(x == 1){
        type = "gesture"
      }
      else{
        type = "pressure"
      }
      changeLanguage_press(e,type, 'gu')
      break;

    case 77: //m - marathi
      window.event.preventDefault();
      var x = rand(1, 2);
      if(x == 1){
        type = "gesture"
      }
      else{
        type = "pressure"
      }
      changeLanguage_press(e,type, 'mr')
      break;
      
    case 80: //p - panjabi
      window.event.preventDefault();
      var x = rand(1, 2);
      if(x == 1){
        type = "gesture"
      }
      else{
        type = "pressure"
      }
      changeLanguage_press(e,type, 'pa')
      break;
  }
});
