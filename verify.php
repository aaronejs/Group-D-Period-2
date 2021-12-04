<?php
include './includes/database.php';

$vkey = $_GET['vkey'];
$sql = "UPDATE user SET verified = 1 WHERE vkey = ?";

if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
  mysqli_stmt_bind_param($stmt, "s", $vkey); //need to bind values to parameters
  if(mysqli_stmt_execute($stmt)){ //execute the statement
    header("location:./login.php?success=verified");
  }else {
    header("location:./register.php?error=verification");
    die(mysqli_error($conn));
  }
}else{
  die(mysqli_error($conn));
}
?>
