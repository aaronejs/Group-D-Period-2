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
				header("location:./login.php");
			}
    ?>
		<main>
			<div class="bigBox">
				<?php
				include './includes/search.php';
				?>
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
