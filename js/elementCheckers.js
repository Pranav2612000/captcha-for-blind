function isAButton(ele) {
  console.log(ele);
  var buttons = document.getElementsByClassName('ca-button');
  var buttons_array = [...buttons];
  if (buttons_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}

function isAInput(ele) {
  var inputs = document.getElementsByTagName('input');
  var inputs_array = [...inputs];
  if (inputs_array.includes(ele)) {
    return true;
  } else {
    return false;
  }
}
