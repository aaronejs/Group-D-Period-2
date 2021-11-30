<!DOCTYPE html>
<html lang="en">
<head>
  <title>BookIT Stenden</title>
<!--
</head>
<body>
-->
    <?php
    include './includes/header.php'; // header
    ?>
    <main>

<?php 
$date = date("Y-m-d");
$time = date("H:i");
?>

      <div class="bigBox">
        <form>
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
              <img src="./resources/Search.png" id="searchImg">
            </button>
          </div>
        </form>
        <h1>1Making reservations</h1>
        <div class="mainItem">
          <p>Making reservations can be done by using the search bar located above. Here you will enter the amount of people that you need. There will be more information in this paragraph when the website will be built. This is just text to fill up the paragraph so it looks like a similar size to when it will go live.</p>
          <img src="./resources/Working.png">
        </div>
        <h1>2Making reservations</h1>
        <div class="mainItem">
          <p>Making reservations can be done by using the search bar located above. Here you will enter the amount of people that you need. There will be more information in this paragraph when the website will be built. This is just text to fill up the paragraph so it looks like a similar size to when it will go live.</p>
          <img src="./resources/Working.png">
        </div>
        <h1>3Making reservations</h1>
        <div class="mainItem">
          <p>Making reservations can be done by using the search bar located above. Here you will enter the amount of people that you need. There will be more information in this paragraph when the website will be built. This is just text to fill up the paragraph so it looks like a similar size to when it will go live.</p>
          <img src="./resources/Working.png">
        </div>
      </div>
    </main>
    <?php
    include './includes/footer.html'; // footer
    ?>
  </div>
</body>
</html>
