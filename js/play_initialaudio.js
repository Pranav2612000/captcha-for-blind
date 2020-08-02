no_of_times_audio = 1;
document.addEventListener("click", function() {
  if(no_of_times_audio) {
    var audio = new Audio( base_url + 'assets/sounds/guides/Hindi_pop_up_instruction.mp3');
    audio.play();
  }
  no_of_times_audio--;
});
