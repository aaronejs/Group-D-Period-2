<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Schedule</title>
  <?php
    include './includes/head.html';
  ?>
</head>
<body>
  <?php
  include './includes/header.php'; // header
  if(!isset($_SESSION['sessionID'])) {
    header("location:./login.php?error=login");
  }
  ?>
  <div class="schedule">
    <div class="week">
      <h1>Week <?php echo idate('W',strtotime(date("Y/m/d"))) ?></h1>
    </div>
    <div class="monday">
      <p>monday</p>
    </div>
    <div class="tuesday">
      <p>tuesday</p>
    </div>
    <div class="wednesday">
      <p>wednesday</p>
    </div>
    <div class="thursday">
      <p>thursday</p>
    </div>
    <div class="friday">
      <p>friday</p>
    </div>
    <div class="saturday">
      <p>saturday</p>
    </div>
    <div class="sunday">
      <p>sunday</p>
    </div>

    <?php

      /*function dayAssigner($fName,$lName,$roomNr,$startTime,$endTime){    It's gonna work at some point, trust
        echo'
              <h5>'.$fName.' '.$lName.'</h5>
              <p>Room:'.$roomNr.'</p>
              <p>Time:'.$startTime.'-'.$endTime.'</p>
            ';
      }*/

      include './includes/database.php';
      $sql="SELECT U.first_name, U.last_name, R.room_nr, B.start_time, B.end_time, B.date
            FROM booking B
            JOIN room R ON B.room_id=R.id
            JOIN user U ON B.user_id=U.id
            ORDER BY B.start_time;";

      if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt,$fName,$lName,$roomNr,$startTime,$endTime,$date);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) != 0){
          while(mysqli_stmt_fetch($stmt)){
            $dayofweek = date('l', strtotime($date));
            $weekofyear = idate('W',strtotime($date));
            
            if ($dayofweek=="Monday") {
              echo'
              <div class="monday">
              <h4>'.$fName.' '.$lName.'</h4>
              <p>Room: '.$roomNr.'</p>
              <p>Time: '.$startTime.' - '.$endTime.'</p> 
              </div>
              ';
            }
            if ($dayofweek=="Tuesday") {
              echo'
              <div class="tuesday">
              <h4>'.$fName.' '.$lName.'</h4>
              <p>Room: '.$roomNr.'</p>
              <p>Time: '.$startTime.' - '.$endTime.'</p> 
              </div>
              ';
            }
            if ($dayofweek=="Wednesday") {
              echo'
              <div class="wednesday">
              <h4>'.$fName.' '.$lName.'</h4>
              <p>Room: '.$roomNr.'</p>
              <p>Time: '.$startTime.' - '.$endTime.'</p> 
              </div>
              ';
            }
            if ($dayofweek=="Thursday") {
              echo'
              <div class="thursday">
              <h4>'.$fName.' '.$lName.'</h4>
              <p>Room: '.$roomNr.'</p>
              <p>Time: '.$startTime.' - '.$endTime.'</p> 
              </div>
              ';
            }
            if ($dayofweek=="Friday") {
              echo'
              <div class="friday">
              <h4>'.$fName.' '.$lName.'</h4>
              <p>Room: '.$roomNr.'</p>
              <p>Time: '.$startTime.' - '.$endTime.'</p> 
              </div>
              ';
            }
            if ($dayofweek=="Saturday") {
              echo'
              <div class="saturday">
              <h4>'.$fName.' '.$lName.'</h4>
              <p>Room: '.$roomNr.'</p>
              <p>Time: '.$startTime.' - '.$endTime.'</p> 
              </div>
              ';
            }
            if ($dayofweek=="Sunday") {
              echo'
              <div class="sunday">
              <h4>'.$fName.' '.$lName.'</h4>
              <p>Room: '.$roomNr.'</p>
              <p>Time: '.$startTime.' - '.$endTime.'</p> 
              </div>
              ';
            }
          }
        }
        else{
            echo "nothing to show";
          }
      }
      else{
        echo"beep boop db error";
      }
    ?>
  </div>
  <?php
  include './includes/footer.html'; // footer
  ?>
</body>
</html>
