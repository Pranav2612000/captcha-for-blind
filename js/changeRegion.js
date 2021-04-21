function changeRegion(e) {
  console.log(document.getElementById("region").value);
  e.preventDefault();
  $.ajax({
    //url:"../backend/captcha_pages/questionnaire.php",
    url: "../backend/index.php",
    method: "POST",
    data: {
      captcha_type: "questionnaire",
      lang: "en",
      region: document.getElementById("region").value,
      open: "1",
    },
    success: function (data) {
      jQuery("#captcha").html(data);
    },
  });
}
