<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="main.css">
		<title>Reservation</title>
	</head>
	<body>
    <?php
      include './includes/header.php'; // Header
			if(!isset($_SESSION['sessionID'])){
				header("location:./login.php?error=login");
			}
    ?>
		<main>
			<div class="bigBox">
				<?php
				$error = NULL;
				$error2 = NULL;
				include './includes/search.php';
				include './includes/database.php';
				include './includes/functions.php';

				$sql = "SELECT * FROM booking WHERE (`date` = ?) AND (start_time <= ?) AND (end_time >= ?)"; //referencing logic to De Morgan's law
				if(isset($_POST['startTime']) && isset($_POST['endTime'])){
					if(validateTime($_POST['startTime']) && validateTime($_POST['endTime'])){
						$startTime = $_POST['startTime'];
						$endTime = $_POST['endTime'];
					}
				}
				if($startTime < $endTime){
					if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
						mysqli_stmt_bind_param($stmt, "sss", $_POST['searchDate'], $_POST['endTime'], $_POST['startTime']); //bind the param to be the email from the form
						if(!mysqli_stmt_execute($stmt)){ //execute the statement
							$error = "Error executing query" . mysqli_error($conn);
							die(); //die if we cant execute statement
						}
						mysqli_stmt_bind_result($stmt, $id, $user_id, $reserved_id, $room_id, $start_time, $end_time, $date);
						mysqli_stmt_store_result($stmt);
					}else{
						$error = "Error: " . mysqli_error($conn);
					}

					if(mysqli_stmt_num_rows($stmt) != 0){
						while(mysqli_stmt_fetch($stmt)){
							echo $id;
						}
					}else{
						$error = "No bookings!";
					}
				}else {
					$error2 = "End time can not be bigger than start time!";
				}
				?>

				<?= $error ?>
				<?= $error2 ?>
				<div class="mainItem">
					<img src="./resources/map.png" alt="Map" class="reserveMap">
					<div class="formReserve">
						<form method="post" class="form">
							<p><label for="numberOfPeople">Number Of People</label></p>
							<p><label for="laptop">Laptop</label>
							<input type="checkbox" name="laptop" class="reserveCheckbox"></p>
							<p><label for="extensionCabel">Extension Cabel</label>
							<input type="checkbox" name="extensionCabel" class="reserveCheckbox"></p>
							<p><label for="tv">TV</label>
							<input type="checkbox" name="tv" class="reserveCheckbox"></p>
							<p><label for="option">Option</label>
							<input type="checkbox" name="option" class="reserveCheckbox"></p>
							<p><label for="option">Option</label>
							<input type="checkbox" name="option" class="reserveCheckbox"></p>
							<input type="submit" name="confirm" value="Confirm" class="reserveButton">
						</form>
					</div>
				</div>
				<div class="reserveText">
					<img src="./resources/ReservePic.png" alt="Thinking person illustration" class="reservePicture">
					<div>
						<h1 class="reserveParagraphHeader">Top Quality Education</h1>
						<p>We’re not only independently rated as one of the top 3 universities of applied sciences in the Netherlands, our students also highly rank the value of our education. Our top facilities, professional lecturers, real-world projects and international environment mean students earn degrees that really work in industry.</p>
					</div>
				</div>
			</div>
		</main>
	    <!--- End of Main body --->
        <?php
            include './includes/footer.html'; // Footer
        ?>
	</body>
</html>
