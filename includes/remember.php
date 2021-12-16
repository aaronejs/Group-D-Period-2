<?php
include './includes/database.php';

if(isset($_COOKIE['userid']) && isset($_COOKIE['token'])){
  $sql = "SELECT id, token, first_name, last_name FROM user WHERE id = ?";
  if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
    mysqli_stmt_bind_param($stmt, "s", $_COOKIE['userid']); //need to bind values to parameters
    if(mysqli_stmt_execute($stmt)){
      mysqli_stmt_bind_result($stmt, $id, $token, $firstname, $lastname); //bind results
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) != 0){
        while(mysqli_stmt_fetch($stmt)){
          if(password_verify($token, $_COOKIE['token'])){
            $_SESSION['firstname'] = $firstname; //set session variables to use across pages
            $_SESSION['lastname'] = $lastname;
            $_SESSION['sessionID'] = $id;
          }else {
            header("location:./logout.php");
          }
        }
      }
    }
  }
}

?>
