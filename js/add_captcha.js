$(document).ready(function () {
  var captcha_type = $("#captcha").attr("class");
  $("#captcha").attr("role", "button");
  $("#captcha").attr("aria-pressed", "false");
  $("#captcha").attr("tabindex", "0");
  console.log(captcha_type);
  $.ajax({
    //url:"../backend/captcha_pages/questionnaire.php",
    url: "../backend/index.php",
    method: "POST",
    data: { captcha_type: captcha_type, lang: "en", open: "0" },
    success: function (data) {
      jQuery("#captcha").html(data);
    },
  });
});
