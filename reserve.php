<!DOCTYPE html>
<html>
<head>
	<title>Reservation</title>
    <?php
    	include './includes/head.html';
    ?>
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
			}else {
				if(isset($_GET['error'])) {
					if($_GET['error'] == 'unsetfields') {
	          echo "<p class='warning'>Please fill in all fields!</p>";
	        }
				}
				$error2 = "<br><p>Please choose a time and date!</p>";
			}
			if($startTime < $endTime){
				if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
					mysqli_stmt_bind_param($stmt, "sss", $_POST['searchDate'], $endTime, $startTime); //bind the param to be the email from the form
					if(!mysqli_stmt_execute($stmt)){ //execute the statement
						$error = "Error executing query" . mysqli_error($conn);
						die(); //die if we cant execute statement
					}else {
						mysqli_stmt_bind_result($stmt, $id, $user_id, $room_id, $occupancy, $start_time, $end_time, $date);
						mysqli_stmt_store_result($stmt);
						$availability1=$availability2=$availability3=$availability4=$availability5=$availability6=$availability7 = "roomSelect";
						$_SESSION['startTime'] = $startTime;
						$_SESSION['endTime'] = $endTime;
						$_SESSION['date'] = $_POST['searchDate'];
						if(mysqli_stmt_num_rows($stmt) != 0){
							while(mysqli_stmt_fetch($stmt)){
								$array = str_split($room_id);
								foreach ($array as $key) {

									if($key == 1){
										$availability1 = "roomNoSelect";
									}
									elseif($key == 2){
										$availability2 = "roomNoSelect";
									}
									elseif($key == 3){
										$availability3 = "roomNoSelect";
									}
									elseif($key == 4){
										$availability4 = "roomNoSelect";
									}
									elseif($key == 5){
										$availability5 = "roomNoSelect";
									}
									elseif($key == 6){
										$availability6 = "roomNoSelect";
									}
									elseif($key == 7){
										$availability7 = "roomNoSelect";
									}
								}
							}
						}else{
							$error = "<p>No bookings!</p>";
						}
					}
				}else{
					$error = "Error: " . mysqli_error($conn);
				}
			}else {
				$error2 = "End time can not be bigger than start time!";
			}
			?>

			<?= $error ?>
			<?= $error2 ?>
			<div class="mainItem">
				<div class="room-content">
			<div class="select-room">
				<svg width="719" height="374" viewBox="0 0 719 374" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<rect x="0.716064" y="2.43384" width="717" height="371" transform="rotate(-0.116409 0.716064 2.43384)" fill="url(#pattern0)"/>
												<rect x="555" y="342" width="48" height="22" transform="rotate(-0.116409 544 58.2764)"  fill-opacity="0.56" id="room_1" class="<?=$availability1?>"/>
												<rect x="439" y="304" width="79" height="59" transform="rotate(-0.116409 48.8297 58.3362)" fill-opacity="0.56" id="room_2" class="<?=$availability2?>"/>
												<rect x="439" y="256" width="79" height="45" transform="rotate(-0.116409 48.8297 58.3362)" fill-opacity="0.56" id="room_3" class="<?=$availability3?>"/>
												<rect x="301" y="256" width="134" height="57" transform="rotate(-0.116409 48.8297 58.3362)" fill-opacity="0.56" id="room_4" class="<?=$availability4?>"/>
												<rect x="113" y="222" width="92" height="91" transform="rotate(-0.116409 48.8297 58.3362)" fill-opacity="0.56" id="room_5" class="<?=$availability5?>"/>
						<rect x="113" y="132" width="93" height="86" transform="rotate(-0.116409 417.829 57.5865)"  fill-opacity="0.68" id="room_6" class="<?=$availability6?>"/>
						<rect x="402" y="20" width="124" height="85" transform="rotate(-0.116409 417.829 57.5865)"  fill-opacity="0.68" id="room_7" class="<?=$availability7?>"/>
						<defs>
						<pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
						<use xlink:href="#image0_531_1277" transform="translate(0 -0.000409126) scale(0.000892857 0.00172555)"/>
						</pattern>
					</defs>
					</svg>
				<img src="./resources/room.svg" alt="" class="bg-room">
			</div>
			<div class="room-params" id="params" style="">
				<div class="tabs-btns">
					<div class="tab-btn active" id="btn1">Room</div>
					<div class="tab-btn" id="btn2">Equipment</div>
				</div>
				<div class="tabs">
					<div class="tab" id="room">

						<form method="post" action="book.php" style="">
							<div>
								Select Room
								<select name="selectRoom" id="selectRoom">
									<?php
									$sql = "SELECT r.id, r.floor_nr, r.room_nr FROM room r WHERE r.id NOT IN (SELECT b.room_id FROM booking b WHERE (b.date = ?) AND (b.start_time <= ?) AND (b.end_time >= ?))";

									if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
										mysqli_stmt_bind_param($stmt, "sss", $_POST['searchDate'], $endTime, $startTime);
										if(!mysqli_stmt_execute($stmt)){ //execute the statement
											$error = "Error executing query" . mysqli_error($conn);
											die($error); //die if we cant execute statement
										}else {
											mysqli_stmt_bind_result($stmt, $room_id, $floor_nr, $room_nr);
											mysqli_stmt_store_result($stmt);
											if(mysqli_stmt_num_rows($stmt) != 0){
												while(mysqli_stmt_fetch($stmt)){
													$zeros = strlen($room_nr);
													if($zeros == 1) {
														$zero = "00";
													}
													elseif($zeros == 2) {
														$zero = "0";
													}
													else{
														$zero = "";
													}
													echo "<option value='" . $room_id . "'>" . $floor_nr . "." . $zero . "" . $room_nr . "</option>";
												}
											}
										}
									}
									?>
								</select>
							</div>
							<div>
								Number of people:
								<input type="number" class="occupancy" name="occupancy" min="1" max="24" value="1">
								<input type="submit" name="submit" value="Confirm">
							</div>
						</form>
					</div>
					<div class="tab" id="equipment" style="display:none">
						<div class="">
							<p><b>Select items</b></p>
						</div>
						<form action="items.php" method="post">
						<?php
							$sql = "SELECT b.id, r.room_nr, r.floor_nr, b.date FROM booking b, room r WHERE b.user_id = ? AND r.id = b.room_id";

							if($stmt = mysqli_prepare($conn, $sql)){
								mysqli_stmt_bind_param($stmt, "s", $_SESSION['sessionID']);
								if(!mysqli_stmt_execute($stmt)){
									$error = "Error executing query" . mysqli_error($conn);
									die($error); //die if we cant execute statement
								}else {
									mysqli_stmt_bind_result($stmt, $booking_id, $a_room_nr, $a_floor_nr, $booking_date);
									mysqli_stmt_store_result($stmt);
									echo "<div class='items'>";
									echo "Add items to a booking:";
									echo "</div><div class='items'>";
									echo "<select name='selectItems' id='selectItem'>";
									echo "<option selected='selected' value='NULL'>Book separately</option>";
									if(mysqli_stmt_num_rows($stmt) == 0){
										echo "</select>";
										echo "</div>";
									}else{
										while(mysqli_stmt_fetch($stmt)){
											$zeros = strlen($room_nr);
											if($zeros == 1) {
												$zero = "00";
											}
											elseif($zeros == 2) {
												$zero = "0";
											}
											else{
												$zero = "";
											}
											echo "<option value='" . $booking_id . "'>" . "Room nr: " . $a_floor_nr . "." . $zero . "" . $a_room_nr . " Date: " . $booking_date . "</option>";
										}
										echo "</select>";
										echo "</div>";
									}
								}
							}
							$sql = "SELECT i.id, i.item_name, i.quantity, SUM(r.amount_reserved) FROM item i LEFT JOIN reserved_item r on i.id=r.item_id GROUP BY i.id";
							if($stmt = mysqli_prepare($conn, $sql)){
								if(!mysqli_stmt_execute($stmt)){
									$error = "Error executing query" . mysqli_error($conn);
									die($error); //die if we cant execute statement
								}else {
									mysqli_stmt_bind_result($stmt, $item_id, $item_name, $item_quantity, $amount_reserved);
									mysqli_stmt_store_result($stmt);
									if(mysqli_stmt_num_rows($stmt) != 0){
										while(mysqli_stmt_fetch($stmt)){
											echo "<div class='items'>";
											echo "<input type='checkbox' name=$item_name value=$item_id>";
											echo "$item_name";
											if($item_quantity - $amount_reserved > 0){
												if($_SESSION['type'] == "student"){
													$maxAmount = 5;
												}else
													$maxAmount = $item_quantity - $amount_reserved;

												echo "<input type='number' class='occupancy' name='" . "$item_id" . "_amount" ."' min='1' max='$maxAmount' value='1'>";
											}
											echo "</div>";
										}
									}
								}
							}
							mysqli_stmt_close($stmt); //close statement
							mysqli_close($conn); //close connection
							?>
							<input type="submit" name="submit" value="Confirm" class="submit">
						</form>
					</div>
				</div>
			</div>
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
				<script src="room.js"></script>

</body>
</html>
