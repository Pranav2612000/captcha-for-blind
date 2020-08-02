function toggleCaptcha() {
  console.log('opening');
  var captcha_body = document.getElementsByClassName("ca-panel-body")[0];
  var placeholder = document.getElementsByClassName("ca-placeholder-body")[0]; 
  console.log(captcha_body);
  if (captcha_body.style.display === "none") {
    captcha_body.style.display = "block";
    placeholder.style.display = "none";
  }
}
