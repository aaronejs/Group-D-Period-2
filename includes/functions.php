<?php
function validateTime($time){
  $sub1 = substr($time, 0, 2);
  $sub2 = substr($time, 2, 1);
  $sub3 = substr($time, -2, 2);

  if($sub2 == ":"){
    if(preg_match('/^[1-9][0-9]*$/', $sub1) && preg_match('/^[1-9][0-9]*$/', $sub3)){
      $result = true;
    }else
      $result = false;
  }else
    $result = false;
  return $result;
}
?>
