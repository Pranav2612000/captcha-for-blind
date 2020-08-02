<?php
function add_switch_region_elem() {
  echo "
    <div>
      <select name='region' id='region' onchange='changeRegion(event)'>
        <option value='default'>Default</option>
        <option value='punjab'>Punjab</option>
        <option value='andhrapradesh'>Andhra Pradesh</option>
        <option value='maharastra'>Maharastra</option>
        <option value='westbengal'>West Bengal</option>
      </select>
    </div>
    ";
  return;
}
?>
