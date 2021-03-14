var audio;
var audio_l;

function play_ins(){
  audio = new Audio( base_url + 'assets/audio/guides/page_load_final.mp3');
  audio.play();
}
function play_change_lang(){
  audio_l = new Audio( base_url + 'assets/audio/guides/lg_ins_mod.mp3');
  audio_l.play();
}

function toggleCaptcha(e) {
  var switch_audio_elem = document.getElementById('ca-switch-lang-icon');
  //console.log(e.target);
  //console.log(switch_audio_elem);
  if(e.target == switch_audio_elem) {
    return;
  }
  if(in_scope == false) {
    return;
  }
  if(validation_com == true) {
    return;
  }
  if(isABtnIcon(e.target)) {
    return;
  }
  if(isAHelperBtn(e.target)) {
    return;
  }
  console.log('opening');
  var captcha_body = document.getElementsByClassName("ca-panel-body")[0];
  var placeholder = document.getElementsByClassName("ca-placeholder-body")[0]; 
  //document.getElementsByClassName("ca-button-group")[0].classList.toggle("show");
  console.log(captcha_body);
  if (captcha_body && captcha_body.style.display === "none") {
    placeholder.style.borderTop = "none";
    captcha_body.style.display = "block";
    $("#cap_open").show("1000");
    $("#cap_closed").hide("1000");
    ended = false;
    audio = new Audio( base_url + 'assets/audio/guides/page_load_final.mp3');
    audio.play();
    is_open = '0';
  } else {
    captcha_body.style.display = "none";
    placeholder.style.border = "4px solid green";
    $("#cap_open").hide("1000");
    $("#cap_closed").show("1000");
    ended = true;
  }
}
