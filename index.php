<!DOCTYPE html>
<html lang="en">
<head>
  <title>BookIT Stenden</title>
  <?php include './includes/head.html'; ?>
</head>
<body>    
    <?php
    include './includes/header.php'; // header
    ?>
    <main>
      <div class="bigBox">
      <?php
      if(isset($_GET['error'])) {
        if($_GET['error'] == 'type') {
          echo "<p class='warning'>You do not have access to that page.</p>";
        }
        if($_GET['error'] == 'login') {
          echo "<p class='warning'>You are already logged in!</p>";
        }
        if($_GET['error'] == 'register') {
          echo "<p class='warning'>Please log out before registering another account.</p>";
        }
      }
			include './includes/search.php';
			?>
        <div class="mainItem">
          <div class="mainItemText mainItemContent">
            <h1>Making reservations</h1>
            <p>Making reservations can be done by using the search bar located above. Here you can enter at what time you want to reserve a room. When you press the search button, you will be sent to a page where you can select which room and/or items you want to reserve for that timeframe.</p>
          </div>
          <img src="./resources/Working.png" alt="Generic image" class="mainItemContent mainItemImage">
        </div>
        <div class="mainItem">
          <img src="./resources/Traveling.png" alt="Generic image" class="mainItemContent mainItemImage">
          <div class="mainItemText mainItemContent">
            <h1>Discover our events</h1>
            <p>Would you like to experience what it’s like to study in the Netherlands at NHL Stenden University of Applied Sciences? Meet our students and academic staff during our online and offine events! </br><a href="https://www.nhlstenden.com/en/events" target="_blank"><button class="smallSquareButton">Events</button></a></p>
          </div>
        </div>
        <div class="mainItem">
          <div class="mainItemText mainItemContent">
            <h1>Making reservations</h1>
            <p>Making reservations can be done by using the search bar located above. Here you will enter the amount of people that you need. There will be more information in this paragraph when the website will be built. This is just text to fill up the paragraph so it looks like a similar size to when it will go live.</p>
          </div>
          <img src="./resources/Relaxing.png" alt="Generic image" class="mainItemContent mainItemImage">
        </div>
      </div>
    </main>
    <?php
    include './includes/footer.html'; // footer
    ?>
</body>
</html>
