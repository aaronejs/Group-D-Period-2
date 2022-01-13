<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
	<?php include './includes/head.html'; ?>
</head>
<body>
    <?php
      	include './includes/header.php'; // Header
        include './includes/remember.php';
    ?>
	<main>
		<div class="profileGrid">
			<div class="profileColumn1">
				<img src="./resources/design.png" alt="Colored arrows">
			</div>
			<div class="profileColumn2">
				<div class="profileCenter">
					<img src="./resources/default.png" alt="Default Profile Picture">
					<p><button type="submit" name="submit" value="submit" class="profileButton">Upload Profile Picture</button></p>
				</div>
				<div class="profileCenter">
					<h1 class="profileText">Personal Information</h1>
					<fieldset class="profileInfo">
						<legend>Name</legend>
						<?php
								echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
						?>
					</fieldset>
					<fieldset class="profileInfo">
						<legend>Email</legend>
							<?php
								echo $_SESSION['email'];
							?>
					</fieldset>
					<p>
						<a href="#">
							<div class="profileButton">
								Turn Off 2FA
							</div>
						</a>
					</p>
				</div>
				<div class="profileCenter">
					<h1 class="profileText">Change Password</h1>
					<form action="" method="post">
						<p><fieldset class="changePass" id="currentPassword">
							<legend>Old Password</legend>
							<input type="password" name="currentPassword"/>
						</fieldset></p>
						<p><fieldset class="changePass" id="newPassword">
							<legend>New Password</legend>
							<input type="password" name="newPassword"/>
						</fieldset></p>
						<p><fieldset class="changePass" id="confirmPassword">
							<legend>New Password</legend>
							<input type="password" name="confirmPassword"/>
						</fieldset></p>
						<div class="buttonCenter">
							<button type="submit" name="changePass" value="submit" class="passwordButton">Change Password</button>
						</div>
					</form>
					<?php
						$error = NULL;
						if(isset($_POST['changePass'])){ //changePassword = submit button change password
							if (!empty($_POST['currentPassword']) && !empty($_POST['newPassword']) &&
								!empty($_POST['confirmPassword'])){

								$sql = "SELECT password FROM user WHERE id = ?";
								if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
									$id = $_COOKIE['userid'];
									mysqli_stmt_bind_param($stmt, "s", $id); //need to bind values to parameters
									if(mysqli_stmt_execute($stmt)){
									mysqli_stmt_bind_result($stmt, $oldPassword); //bind results
									mysqli_stmt_store_result($stmt);
										if(mysqli_stmt_num_rows($stmt) != 0){
											while(mysqli_stmt_fetch($stmt)){
												if(!password_verify($oldPassword, password_hash($_POST['newPassword'], PASSWORD_DEFAULT))){
													if($_POST['newPassword'] == $_POST['confirmPassword']){
														if (strlen(trim($_POST['newPassword'])) > 6){

															$sql = "UPDATE user set password = ? WHERE id = ?";
															if($stmt = mysqli_prepare($conn, $sql)){
																$password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
																mysqli_stmt_bind_param($stmt, "ss", $password, $id);
																if(!mysqli_stmt_execute($stmt)){ //execute the statement
																	$error = "Error executing query" . mysqli_error($conn);
																	die();
																} else{
																	echo "Password changed successfully";
																}
															} else{
																$error = "Error: " . mysqli_error($conn);
                            									die(); //die if we cant prepare statement
															}

														} else{
															$error = 'Password must be longer than 6 characters';
														} //password much be longer then 6 characters
													} else{
														$error = 'Passwords does not match'; // checks if the new passwords match
													 }
												}else {
													$error = 'Password can not be the same';
												}
											}
										}
									} else{
										$error = "Error: " . mysqli_error($conn);
										die(); //die if we cant prepare statement
									}
								} else{
									$error = "Error: " . mysqli_error($conn);
                            		die(); //die if we cant prepare statement
								}
							}//fill in all the fields
							if($error != NULL){
								echo "<div class='warning'>".$error."</div>";
							}
						}
					?>
				</div>
			</div>
			<div class="profileColumn3">
				<img src="./resources/design1.png" alt="Colored arrows">
			</div>
		</div>
	</main>
	<?php
		include './includes/footer.html'; // Footer
	?>
</body>
</html>
