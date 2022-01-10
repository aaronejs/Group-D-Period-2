<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php include './includes/head.html'; ?>
<link href="./css/login.css" rel="stylesheet" type="text/css">
<title>Maintanance Page</title>
</head>
<body>    
    <?php
    include './includes/header.php'; // header
    ?>
        <main>
            <div class="center">
                <div class="formBox">
                    <div class="contentText">
                    <h1>Add an Item</h1>
                    </div>
                    <div class="form">
                        <form method="post">
                        <div>
                            <fieldset>
                            <legend>Item Name</legend>
                            <input type="text" name="Iname">
                            </fieldset>
                        </div>
                        <div>
                            <fieldset>
                            <legend>Quantity</legend>
                            <input type="text" name="Iquan">
                            </fieldset>
                        </div>
                        <div>
                        <input type="submit" name="additem" value="Create Item">
                        </div>
                        <div class="center">
                        <p>Want to add a Room?</p> <a href="./addroom.php">Click here.</a>
                        </div>
                        </form>  
                    </div>
                </div>
            </div>          
        </main>
        <?php
        include './includes/database.php';
        session_start();

        if(isset($_POST['additem'])){
          if(!empty($_POST['Iname']) && !empty($_POST['Iquan'])){
            $Item_Name = $_GET['Iname'];
            $Quantity = $_GET['Iquan'];
            $sql = "INSERT INTO Item (user_id, $Item_Name, $Quantity)
                    VALUES (?,?,?)";
            if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
            mysqli_stmt_bind_param($stmt, "sss", $_SESSION['sessionID'], $Item_Name, $Quantity); //bind the param to be the email from the form
            if(!mysqli_stmt_execute($stmt)){ //execute the statement
              $error = "Error executing query" . mysqli_error($conn);
              die($error); //die if we cant execute statement
              }
            }
          }
        }
        ?>
        <?php
          include './includes/footer.html'; // Footer
        ?>
    </body> 
