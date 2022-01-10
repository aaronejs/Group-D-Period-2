<?php
include './includes/database.php';
session_start();

if(isset($_POST['submit'])){
  if(isset($_POST['selectItems'])){
    $sql = "SELECT id, item_name, quantity FROM item";
    if($stmt = mysqli_prepare($conn, $sql)){
      if(!mysqli_stmt_execute($stmt)){
        $error = "Error executing query" . mysqli_error($conn);
        die($error); //die if we cant execute statement
      }else {
        mysqli_stmt_bind_result($stmt, $item_id, $item_name, $item_quantity);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) != 0){
          $count1 = 0;
          $count2 = 0;
          while(mysqli_stmt_fetch($stmt)){
            if($item_name){
              $count1++;
            }
            if(isset($_POST[$item_name])){
              $count2++;
              $array[] = $_POST[$item_name];
            }
          }
          if($count1-$count2 >= 0 && $count2 != 0){
            //echo "Good boy";

            foreach ($array as $key) {
              $amount = $_POST[$key."_amount"];
              if(filter_var($amount, FILTER_SANITIZE_NUMBER_INT)){
                if($amount > 0){
                  $data[$key] = $amount;
                }else {
                  header("location: ./index.php");
                }
              }else
                header("location: ./index.php");
            }

            foreach ($data as $item_id => $amount_reserved) {
              echo $item_id . "=>" . $amount_reserved . "<br>";
              $sql = "INSERT INTO reserved_item (user_id, item_id, amount_reserved) VALUES (?,?,?);";
              if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "sss", $_SESSION['sessionID'], $item_id, $amount_reserved);
                if(!mysqli_stmt_execute($stmt)){
                  $error = "Error executing query" . mysqli_error($conn);
                  die($error); //die if we cant execute statement
                }
              }
            }
            mysqli_stmt_close($stmt); //close statement
            mysqli_close($conn); //close connection
            if ($_POST['selectItems'] != "NULL") {
              echo $_POST['selectItems'];

            }

          }else
            header("location: ./reserve.php?error=unsetfields");
        }
      }
    }
  }
}else
  header("location: ./index.php");

?>
