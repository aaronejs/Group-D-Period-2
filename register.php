<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
  <!--
  </head>
  <body>
  -->
    <?php
      include './includes/header.php'; // Header
      include './includes/database.php'; //database connection
    ?>
      <main>
        <div class="center">
          <div class="formBox">
            <div class="contentText">
              <h2>Welcome</h2>
            </div>
            <div class="contentText">
              <h1>Create your account</h1>
            </div>
            <div class="form">
              <form method="post" autocomplete="off">
                <div>
                  <fieldset>
                    <legend>first name</legend>
                    <input type="text" name="firstname">
                  </fieldset>
                </div>
                <div>
                  <fieldset>
                    <legend>last name</legend>
                    <input type="text" name="lastname">
                  </fieldset>
                </div>
                <div>
                  <fieldset>
                    <legend>password</legend>
                    <input type="password" name="password">
                  </fieldset>
                </div>
                <div>
                  <fieldset>
                    <legend>confirm password</legend>
                    <input type="password" name="passwordConfirm">
                  </fieldset>
                </div>
                <div>
                  <fieldset>
                    <legend>email</legend>
                    <input type="email" name="email">
                  </fieldset>
                </div>
                <div>
                  <input type="submit" name="register" value="Create Account">
                </div>
              </form>
            </div>
            <?php
            if (isset($_POST['register'])) {
              if (!empty($_POST['firstname']) && !empty($_POST['lastname']) &&
                  !empty($_POST['password']) && !empty($_POST['passwordConfirm']) &&
                  !empty($_POST['email'])){
                if($_POST['password'] == $_POST['passwordConfirm']){
                  if (strlen(trim($_POST['password'])) > 6) {
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $sql = "INSERT INTO user (first_name, last_name, email, password)
                          VALUES (?,?,?,?)";
                  }else {
                    echo "<div class='warning'>Password must be longer than 6 characters!</div>";
                  }
                }else{
                  echo "<div class='warning'>Passwords do not match!</div>";
                }
              }else {
                echo "<div class='warning'>Please fill in all fields!</div>";
              }
            }
            ?>
          </div>
        </div>
      </main>
      <?php
        include './includes/footer.html'; // Footer
      ?>
    </div>
  </body>
</html>
