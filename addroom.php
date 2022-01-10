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
    </body>
