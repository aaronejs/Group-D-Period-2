<?php
include './includes/database.php'; // Header
session_start();

function turnOff($conn){
  $sql = "UPDATE `user` SET `2FA` = '0' WHERE `user`.`id` = ?;";
  if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['sessionID']);
    if(!mysqli_stmt_execute($stmt)){ //execute the statement
      $error = "Error executing query" . mysqli_error($conn);
      die(); //die if we cant execute statement
    }else
      mysqli_stmt_close($stmt); //close statement
      mysqli_close($conn); //close connection
      header("location: ./index.php?success=2FAoff");
  }
}
function turnOn($conn){
  $sql = "UPDATE `user` SET `2FA` = '1' WHERE `user`.`id` = ?;";
  if($stmt = mysqli_prepare($conn, $sql)){
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['sessionID']);
    if(!mysqli_stmt_execute($stmt)){ //execute the statement
      $error = "Error executing query" . mysqli_error($conn);
      die(); //die if we cant execute statement
    }else
      mysqli_stmt_close($stmt); //close statement
      mysqli_close($conn); //close connection
      header("location: ./index.php?success=2FAon");
  }
}
$sql = "SELECT 2FA FROM user WHERE id = ?";
if($stmt = mysqli_prepare($conn, $sql)){
  mysqli_stmt_bind_param($stmt, 's', $_SESSION['sessionID']);
  if(mysqli_stmt_execute($stmt)){
  mysqli_stmt_bind_result($stmt, $twoFac); //bind results
  mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt) != 0){
      while(mysqli_stmt_fetch($stmt)){
        if($twoFac != 0)
          turnOff($conn);
        else
          turnOn($conn);
      }
    }
  }
}
?>
