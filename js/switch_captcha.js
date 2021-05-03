function switchCaptcha(e, type) {
  e.preventDefault();
  console.log(type);
  var el = document.querySelector('body'),
      elClone = el.cloneNode(true);

  el.parentNode.replaceChild(elClone, el);
  //console.log(document.getElementById("region").value)
  $.ajax({
    //url:"../backend/captcha_pages/questionnaire.php",
    url: "../backend/index.php",
    method: "POST",
    data: {
      captcha_type: type,
      lang: "en",
      region: "punjab",
      open: "1",
    },
    success: function (data) {
      jQuery("#captcha").html(data);
    },
  });
}
