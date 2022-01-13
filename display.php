<?php
include './includes/database.php';
session_start();
if(!isset($_SESSION['type'])){
  header("location: ./index.php");
}else {
  if($_SESSION['type'] == "screen"){
    if(isset($_GET['room'])){
      $roomid = filter_var($_GET['room'], FILTER_SANITIZE_NUMBER_INT);
    }
  }else
    header("location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>BookIT Stenden</title>
  <?php
  include './includes/head.html';
  $page = $_SERVER['PHP_SELF'];
  $time = 60;
  ?>
  <meta http-equiv="refresh" content="<?php echo $time?>;URL='<?php echo $page . "?room=" . $roomid;?>'">
</head>
<body>
  <div class="back">
    <a href="./rooms.php"><h2>&lt;Back</h2></a>
  </div>
    <div class="bookings">

      <?php
      $time = date("H:i");
      $date = date("Y-m-d");
      $sql = "SELECT b.id, u.first_name, u.last_name, b.occupancy, b.start_time, b.end_time, b.date, r.floor_nr, r.room_nr
              FROM booking b, room r, user u
              WHERE (b.start_time <= ?) AND (b.end_time >= ?) AND (b.date = ?) AND (b.room_id = ?) AND r.id = b.room_id AND u.id = b.user_id";
      if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
        mysqli_stmt_bind_param($stmt, "ssss", $time, $time, $date, $roomid); //bind the param to be the email from the form
        if(!mysqli_stmt_execute($stmt)){ //execute the statement
          $error = "Error executing query" . mysqli_error($conn);
          die(); //die if we cant execute statement
        }else {
          mysqli_stmt_bind_result($stmt, $booking_id, $first_name, $last_name, $occupancy, $start_time, $end_time, $date, $floor_nr, $room_nr);
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) != 0){
            while(mysqli_stmt_fetch($stmt)){
              $zeros = strlen($room_nr);
              if($zeros == 1) {
                $zero = "00";
              }
              elseif($zeros == 2) {
                $zero = "0";
              }
              else{
                $zero = "";
              }
              echo "<div class='header'>";
              echo "<h1>Room $floor_nr.$zero$room_nr</h1>";
              echo "</div>";
              echo "<div class='content'>";
              echo "  Reserved by: $first_name $last_name";
              echo "</div>";
              echo "<div class='content'>";
              echo "  Occupants: $occupancy";
              echo "</div>";
              echo "<div class='content'>";
              echo "From: ".substr($start_time, 0, -3)."-".substr($end_time, 0, -3);
              echo "</div>";
            }
          }
        }
      }
      $sql = "SELECT i.item_name, r.amount_reserved
              FROM item i, reserved_item r
              WHERE i.id IN (SELECT r.item_id WHERE r.booking_id = ?) GROUP BY i.item_name;";

      if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
        mysqli_stmt_bind_param($stmt, "s", $booking_id); //bind the param to be the email from the form
        if(!mysqli_stmt_execute($stmt)){ //execute the statement
          $error = "Error executing query" . mysqli_error($conn);
          die(); //die if we cant execute statement
        }else {
          mysqli_stmt_bind_result($stmt, $item_name, $item_amount);
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) != 0){
            while(mysqli_stmt_fetch($stmt)){
              echo "<div class='content'>";
              echo "Item: $item_name  Amount: $item_amount";
              echo "</div>";
            }
          }
        }
      }
      mysqli_stmt_close($stmt); //close statement
      mysqli_close($conn); //close connection
      ?>
    </div>
</body>
</html>
