function getAudio(e) {
  e.preventDefault();
  console.log("in get audio");
  //var txt = jQuery('#txt').val()
  jQuery.ajax({
    //url:'../audio_operations/questionnaire_audio.php',
    //url:'http://localhost/captcha-alternative/backend/audio_operations/questionnaire_audio.php',
    url: base_url + "backend/audio_operations/word_chain_audio.php",
    type: "post",
    success: function (result) {
      jQuery("#ca-player").html(result);
    },
  });
}
