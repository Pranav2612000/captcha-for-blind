function play_ins(){
  var audio = new Audio( base_url + 'assets/audio/guides/page_load.mp3');
  audio.play();
}
function play_change_lang(){
  var audio = new Audio( base_url + 'assets/audio/guides/lang_ins.mp3');
  audio.play();
}

function toggleCaptcha() {
  console.log('opening');
  var captcha_body = document.getElementsByClassName("ca-panel-body")[0];
  var placeholder = document.getElementsByClassName("ca-placeholder-body")[0]; 
  console.log(captcha_body);
  if (captcha_body.style.display === "none") {
    placeholder.style.borderTop = "none";
    captcha_body.style.display = "block";
    //placeholder.style.display = "none";
    play_ins();
  }

 
}
