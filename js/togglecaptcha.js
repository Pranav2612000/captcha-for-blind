var audio;

function play_ins(){
  audio = new Audio( base_url + 'assets/audio/guides/page_load.mp3');
  audio.play();
}
function play_change_lang(){
  var audio_l = new Audio( base_url + 'assets/audio/guides/lang_ins.mp3');
  audio_l.play();
}

var audio;
function toggleCaptcha(e) {
  var switch_audio_elem = document.getElementById('ca-switch-lang-icon');
  console.log(e.target);
  console.log(switch_audio_elem);
  if(e.target == switch_audio_elem) {
    return;
  }
  console.log('opening');
  var captcha_body = document.getElementsByClassName("ca-panel-body")[0];
  var placeholder = document.getElementsByClassName("ca-placeholder-body")[0]; 
  //document.getElementsByClassName("ca-button-group")[0].classList.toggle("show");
  console.log(captcha_body);
  if (captcha_body.style.display === "none") {
    placeholder.style.borderTop = "none";
    captcha_body.style.display = "block";
    $("#cap_open").show("1000");
    $("#cap_closed").hide("1000");
    ended = false;
    //placeholder.style.display = "none";
    //if(audio && audio.paused) {
      audio = new Audio( base_url + 'assets/audio/guides/page_load.mp3');
      audio.play();
    //}
  } else {
    captcha_body.style.display = "none";
    placeholder.style.border = "4px solid green";
    $("#cap_open").hide("1000");
    $("#cap_closed").show("1000");
    ended = true;
  }
}
