<?php
  $date = date("Y-m-d");
  $time = date("H:i");
?>

  <form method="post" action="./reserve.php">
    <div class="searchBox">
      <div class="boxItem">
        <h3>Date</h3>
        <input type="date" name="searchDate" value="<?php echo $date;?>">
      </div>
      <div class="boxItem">
        <h3>Start time</h3>
        <input type="time" name="startTime" value="<?php echo $time;?>">
      </div>
      <div class="boxItem">
        <h3>End time</h3>
        <input type="time" name="endTime" value="<?php echo $time;?>">
      </div>
      <button class="searchButton" type="submit" name="submit">
        <img src="./resources/whiteSearch.png" id="searchImg">
      </button>
    </div>
  </form>
