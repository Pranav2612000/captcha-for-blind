function record(e) {
  e.preventDefault();
  console.log('recording...');
  var recognitaion = new webkitSpeechRecognition();
  console.log(lang)
  console.log("helllo")
  if(lang == "hi"){
    recognitaion.lang = "hi-IN";
  }
  else{
    recognitaion.lang = "en-IN";
  }
  recognitaion.onresult = function(event) {
    console.log(event);
    document.getElementById('captcha_code').value = document.getElementById('captcha_code').value + event.results[0][0].transcript;
  }
  recognitaion.start();
}
