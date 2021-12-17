<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
        <?php
          include './includes/header.php'; // Header
          include './includes/remember.php'; 
    		?>
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
					<p><button type="submit" name="submit" value="submit" class="profileButton">Turn Off 2FA</button></p>
				</div>
				<div class="profileCenter">
					<h1 class="profileText">Change Password</h1>
					<form action="#" method="post">
						<p><fieldset class="changePass" id="currentPassword">
							<legend>Old Password</legend><br>
							<input type="text" name="oldPassword"/>
						</fieldset></p>
						<p><fieldset class="changePass" id="newPassword">
							<legend>New Password</legend><br>
							<input type="text" name="oldPassword"/>
						</fieldset></p>
						<p><fieldset class="changePass" id="confirmPassword">
							<legend>New Password</legend><br>
							<input type="text" name="newPassword"/>
						</fieldset></p>
						<div class="buttonCenter">
							<button type="submit" name="submit" value="submit" class="profileButton">Change Password</button>
						</div>
					</form>
				</div>
			</div>
			<div class="profileColumn3">
				<img src="./resources/design1.png" alt="Colored arrows">
			</div>
		</div>
       <?php
        	include './includes/footer.html'; // Footer
        ?>
	</body>
</html>