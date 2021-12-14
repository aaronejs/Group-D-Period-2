<?php
  $date = date("Y-m-d");
  $startTime = date("H:i");
  $x = strtotime($startTime . '+ 5 minute');
  $endTime = date("H:i", $x);
?>

  <form method="post" action="./reserve.php">
    <div class="searchBox">
      <div class="boxItem">
        <h3>Date</h3>
        <input type="date" name="searchDate" value="<?php if(isset($_POST['searchDate'])){
          $_SESSION['searchDate'] = $_POST['searchDate'];
          echo $_SESSION['searchDate'];
        }else{
          echo $date;
        }?>">
      </div>
      <div class="boxItem">
        <h3>Start time</h3>
        <input type="time" name="startTime" value="<?php if(isset($_POST['startTime'])){
          $_SESSION['startTime'] = $_POST['startTime'];
          echo $_SESSION['startTime'];
        }else{
          echo $startTime;
        }?>">
      </div>
      <div class="boxItem">
        <h3>End time</h3>
        <input type="time" name="endTime" value="<?php
        if(isset($_POST['endTime'])){
          if($_POST['endTime'] < $_POST['startTime']){
            echo $endTime;
          }
          $_SESSION['endTime'] = $_POST['endTime'];
          echo $_SESSION['endTime'];
        }else{
          echo $endTime;
        }?>">
      </div>
      <button class="searchButton" type="submit" name="submit">
        <img src="./resources/whiteSearch.png" id="searchImg">
      </button>
    </div>
  </form>
