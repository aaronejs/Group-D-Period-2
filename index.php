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
			include './includes/search.php';
			?>
        <div class="mainItem">
          <div class="mainItemText">
            <h1>Making reservations</h1>
            <p>Making reservations can be done by using the search bar located above. Here you can enter at what time you want to reserve a room. When you press the search button, you will be sent to a page where you can select which room and/or items you want to reserve for that timeframe.</p>
          </div>
          <img src="./resources/Working.png" alt="People working">
        </div>
        <div class="mainItem">
          <img src="./resources/Traveling.png">
          <div class="mainItemText">
            <h1>Discover our events</h1>
            <p>Would you like to experience what it’s like to study in the Netherlands at NHL Stenden University of Applied Sciences? Meet our students and academic staff during our online and offine events! </br><a href="https://www.nhlstenden.com/en/events" target="_blank"><button class="squareButton">Events</button></a></p>
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
</body>
</html>
