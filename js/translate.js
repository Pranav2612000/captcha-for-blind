function changeLanguage(e, type) {
  e.preventDefault();
  $.ajax({
   //url:"../backend/captcha_pages/questionnaire.php",
   url:"../backend/index.php",
   method:"POST",
   data:{"captcha_type" : type,
         "lang" : document.getElementById("lang").value
        },
   success:function(data) {
     jQuery('#captcha').html(data);
   }
  });
}
