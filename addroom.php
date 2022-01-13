<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include './includes/head.html'; ?>
<link href="./css/login.css" rel="stylesheet" type="text/css">
<title>Maintanance Page</title>
</head>
<body>    
    <?php
    include './includes/header.php'; // header
    if(!isset($_SESSION['sessionID'])) {
        header("location:./login.php?error=login");
    }
    if($_SESSION['type'] != 'admin') {
        header("location:./index.php?error=type");
    }
    ?>
        <main>
            <div class="center">
                <div class="formBox">
                    <div class="contentText">
                    <h1>Add a Room</h1>
                    </div>
                    <div class="form">
                        <form method="post">
                        <div>
                            <fieldset>
                            <legend>Room Number</legend>
                            <input type="text" name="roomnum">
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                            <legend>Floor Number</legend>
                            <input type="text" name="floornum">
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                            <legend>Capacity</legend>
                            <input type="text" name="cap">
                            </fieldset>
                        </div>
                        <div>
                        <input type="submit" name="createroom" value="Create Room">
                        </div>
                        <div class="center">
                        <p>Want to add an Item?</p> <a href="./additem.php">Click here.</a>
                        </div>
                        </form>  
                    </div>
                </div>
            </div>          
        </main>
        <?php
        include './includes/database.php';

        if(isset($_POST['createroom'])){
          if(!empty($_POST['roomnum']) && !empty($_POST['floornum']) && !empty($_POST['cap'])){
            $Room_nr = $_POST['roomnum'];
            $Floor_nr = $_POST['floornum'];
            $Capacity = $_POST['cap'];
            $sql = "INSERT INTO Item (user_id, $Room_nr, $Floor_nr, $Capacity)
                    VALUES (?,?,?,?)";
            if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
            mysqli_stmt_bind_param($stmt, "ssss", $_SESSION['sessionID'], $Room_nr, $Floor_nr, $Capacity); //bind the param to be the email from the form
            if(!mysqli_stmt_execute($stmt)){ //execute the statement
              $error = "Error executing query" . mysqli_error($conn);
              die($error); //die if we cant execute statement
              }
            }
          }
        }
        ?>
    <?php
    include './includes/footer.html'; // footer
    ?>
    </body>
