<?php
include './includes/database.php';
session_start();

if(isset($_POST['submit'])){
  if(!empty($_POST['selectRoom']) && !empty($_POST['occupancy'])){
    $room_id = filter_var($_POST['selectRoom'], FILTER_SANITIZE_NUMBER_INT);
    $occupancy = filter_var($_POST['occupancy'], FILTER_SANITIZE_NUMBER_INT);
    $startTime = $_SESSION['startTime'];
    $endTime = $_SESSION['endTime'];
    $date = $_SESSION['date'];
    if($room_id && $occupancy){
      $sql = "INSERT INTO booking (user_id, room_id, occupancy, start_time, end_time, `date`)
              VALUES (?,?,?,?,?,?)";
      if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
        mysqli_stmt_bind_param($stmt, "ssssss", $_SESSION['sessionID'], $room_id, $occupancy, $startTime, $endTime, $date); //bind the param to be the email from the form
        if(!mysqli_stmt_execute($stmt)){ //execute the statement
          $error = "Error executing query" . mysqli_error($conn);
          die($error); //die if we cant execute statement
        }else{
          header("location:./userbookings.php");
        }
      }
    }
  }else {
    header("location: ./reserve.php?error=unsetfields");
  }
}else {
  header("location: ./index.php");
}
mysqli_stmt_close($stmt); //close statement
mysqli_close($conn); //close connection
?>
