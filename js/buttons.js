var in_scope = true;
function myFunction(e) {
    e.preventDefault();
    e.stopPropagation();
    in_scope = false;
    document.getElementById("myDropdown").classList.toggle("show");
    $('#myDropdown').show();
    console.log(in_scope);
}

document.onclick = function(event) {
  console.log('undropping');
  event.stopPropagation();
  if (!event.target.matches('#switch_lang')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    in_scope = true;
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
