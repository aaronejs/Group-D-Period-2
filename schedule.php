<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>Schedule</title>
  <?php
    include './includes/head.html';
    if(isset($_GET['week'])) {
      $week = $_GET['week'];
      if(isset($_POST['next'])) {
        $week++;
        $currentweek = $week;
      }
      elseif(isset($_POST['prev'])) {
        $week--;
        $currentweek = $week;
      }
    }
    else{
      $currentweek=idate('W',strtotime(date("Y/m/d")));
      $week = $currentweek;
    }
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
      <h1>Week <?= $currentweek?>
      </h1>
    </div>
    <div class="days">
      <div class="monday day">
        <p>Monday</p>
      </div>
      <div class="tuesday day">
        <p>Tuesday</p>
      </div>
      <div class="wednesday day">
        <p>Wednesday</p>
      </div>
      <div class="thursday day">
        <p>Thursday</p>
      </div>
      <div class="friday day">
        <p>Friday</p>
      </div>
      <div class="saturday day">
        <p>Saturday</p>
      </div>
      <div class="sunday day">
        <p>Sunday</p>
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
        $sql="SELECT U.first_name, U.last_name, R.room_nr, R.floor_nr, B.start_time, B.end_time, B.date
              FROM booking B
              JOIN room R ON B.room_id=R.id
              JOIN user U ON B.user_id=U.id
              ORDER BY B.start_time;";

        if($stmt = mysqli_prepare($conn, $sql)){
          mysqli_stmt_execute($stmt);
          mysqli_stmt_bind_result($stmt,$fName,$lName,$roomNr,$floorNr,$startTime,$endTime,$date);
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) != 0){
            while(mysqli_stmt_fetch($stmt)){
              $dayofweek = date('l', strtotime($date));
              $weekofyear = idate('W',strtotime($date));

              if ($weekofyear==$currentweek) {
                $zeros = strlen($roomNr);
                if($zeros == 1) {
                    $zero = "00";
                }
                elseif($zeros == 2) {
                    $zero = "0";
                }
                else{
                    $zero = "";
                }
                if ($dayofweek=="Monday") {
                  echo'
                  <div class="monday day">
                  <h4>'.$fName.' '.$lName.'</h4>
                  <p>Room: '.$floorNr.'.'.$zero.$roomNr.'</p>
                  <p>Time: '.$startTime.' - '.$endTime.'</p> 
                  </div>
                  ';
                }
                if ($dayofweek=="Tuesday") {
                  echo'
                  <div class="tuesday day">
                  <h4>'.$fName.' '.$lName.'</h4>
                  <p>Room: '.$floorNr.'.'.$zero.$roomNr.'</p>
                  <p>Time: '.$startTime.' - '.$endTime.'</p> 
                  </div>
                  ';
                }
                if ($dayofweek=="Wednesday") {
                  echo'
                  <div class="wednesday day">
                  <h4>'.$fName.' '.$lName.'</h4>
                  <p>Room: '.$floorNr.'.'.$zero.$roomNr.'</p>
                  <p>Time: '.$startTime.' - '.$endTime.'</p> 
                  </div>
                  ';
                }
                if ($dayofweek=="Thursday") {
                  echo'
                  <div class="thursday day">
                  <h4>'.$fName.' '.$lName.'</h4>
                  <p>Room: '.$floorNr.'.'.$zero.$roomNr.'</p>
                  <p>Time: '.$startTime.' - '.$endTime.'</p> 
                  </div>
                  ';
                }
                if ($dayofweek=="Friday") {
                  echo'
                  <div class="friday day">
                  <h4>'.$fName.' '.$lName.'</h4>
                  <p>Room: '.$floorNr.'.'.$zero.$roomNr.'</p>
                  <p>Time: '.$startTime.' - '.$endTime.'</p> 
                  </div>
                  ';
                }
                if ($dayofweek=="Saturday") {
                  echo'
                  <div class="saturday day">
                  <h4>'.$fName.' '.$lName.'</h4>
                  <p>Room: '.$floorNr.'.'.$zero.$roomNr.'</p>
                  <p>Time: '.$startTime.' - '.$endTime.'</p> 
                  </div>
                  ';
                }
                if ($dayofweek=="Sunday") {
                  echo'
                  <div class="sunday day">
                  <h4>'.$fName.' '.$lName.'</h4>
                  <p>Room: '.$floorNr.'.'.$zero.$roomNr.'</p>
                  <p>Time: '.$startTime.' - '.$endTime.'</p> 
                  </div>
                  ';
                }
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

        /*echo '';
        if(isset($_POST['nxt'])){
          $currentweek+=1;
          echo $currentweek;
        }
        if(isset($_POST['pvs'])){
          $currentweek-=1;
          echo $currentweek;
        }*/

        

      ?>
    </div>
      <form class="move" action="schedule.php?week=<?= $week?>" method="post">
                <input type="submit" name="prev" value="Last week">
                <input type="submit" name="next" value="Next week">
      </form>
  </div>
    <?php
    include './includes/footer.html'; // footer
    ?>
</body>
</html>
