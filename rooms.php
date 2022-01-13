<!DOCTYPE html>
<html lang="en">
<head>
  <title>BookIT Stenden</title>
  <?php include './includes/head.html'; ?>
</head>
<body>
    <?php
    include './includes/header.php'; // header
    if(!isset($_SESSION['type'])){
      header("location: ./index.php");
    }else {
      if($_SESSION['type'] != "screen")
        header("location: ./index.php");
    }
    ?>
    <main>
      <div class="bigBox">
        <?php
        $sql = "SELECT id, room_nr, floor_nr FROM room";
        if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
          if(!mysqli_stmt_execute($stmt)){ //execute the statement
            $error = "Error executing query" . mysqli_error($conn);
            die(); //die if we cant execute statement
          }else {
            mysqli_stmt_bind_result($stmt, $room_id, $room_nr, $floor_nr);
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
                echo "<div class='mainItem'>";
                echo "<a href='./display.php?room=$room_id'>Room: $floor_nr.$zero$room_nr</a>";
                echo "</div>";
              }
            }
          }
        }
        ?>
      </div>
    </main>
    <?php
    include './includes/footer.html'; // footer
    ?>
</body>
</html>
