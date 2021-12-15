    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
  <div id="container">
<header>
  <?php
  session_start();
  require_once './includes/remember.php'
  ?>
  <div class="content">
    <div class="logo">
      <img src="./resources/StendenLogo.png" alt="NHL Stenden Logo">
    </div>
    <div class="pages">
      <a href="./index.php"><h2>Home</h2></a>
    </div>
    <div class="pages">
      <a href="schedule.php"><h2>Schedule</h2></a>
    </div>
    <div class="userInfo">
      <?php
      if(isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
        echo "<p><h2>" . $_SESSION['firstname'] . "&nbsp;" . $_SESSION['lastname'] . "</h2></p>";
        echo "<p><a href='./logout.php'>Logout</a></p>";
      }else{
        echo "<p><a href='./login.php'>Login</a></p>";
        echo "<p><a href='./register.php'>Register</a></p>";
      }
      ?>
    </div>
    <!--
    <div class="userImage">

    </div>
    -->
  </div>
</header>
