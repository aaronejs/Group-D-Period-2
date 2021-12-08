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
              <img src="./resources/whiteSearch.png" id="searchImg">
            </button>
          </div>
        </form>
        <div class="mainItem">
          <div class="mainItemText">
            <h1>Making reservations</h1>
            <p>Making reservations can be done by using the search bar located above. Here you will enter the amount of people that you need. There will be more information in this paragraph when the website will be built. This is just text to fill up the paragraph so it looks like a similar size to when it will go live.</p>
          </div>
          <img src="./resources/Working.png" alt="People working">
        </div>
        <div class="mainItem">
          <img src="./resources/Working.png">
          <div class="mainItemText">
            <h1>Making reservations</h1>
            <p>Making reservations can be done by using the search bar located above. Here you will enter the amount of people that you need. There will be more information in this paragraph when the website will be built. This is just text to fill up the paragraph so it looks like a similar size to when it will go live.</p>
          </div>
        </div>
        <div class="mainItem">
          <div class="mainItemText">
            <h1>Making reservations</h1>
            <p>Making reservations can be done by using the search bar located above. Here you will enter the amount of people that you need. There will be more information in this paragraph when the website will be built. This is just text to fill up the paragraph so it looks like a similar size to when it will go live.</p>
          </div>
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
