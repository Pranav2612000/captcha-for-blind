no_of_times_audio = 1;
function load_audio() {
  if(is_open) {
    return;
  }
  if(no_of_times_audio == 1) {
    var audio = new Audio( base_url + 'assets/audio/guides/open_cap_hi.mp3');
    audio.play();
  }
  no_of_times_audio--;
  is_open = 1;
  document.removeEventListener("click", load_audio);
}
document.addEventListener("click", load_audio);

