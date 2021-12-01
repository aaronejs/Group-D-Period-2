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
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                      $firstname = $_POST['firstname'];
                      $lastname = $_POST['lastname'];
                      $email = $_POST['email'];
                      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                      $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES (?,?,?,?)";
                      if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
                        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $password); //need to bind values to parameters
                        if(mysqli_stmt_execute($stmt)){ //check if we can execute the statement
                          mysqli_stmt_close($stmt);
                          mysqli_close($conn);
                          header("location: ./register.php?success=added_record");
                          echo "<div class='success'>Successfully registered!</div>";
                        }else{
                          die(mysqli_error($conn));//die if we cant execute statement
                        }
                      }else{
                        echo "Error: " . mysqli_error($conn);
                      }
                    }else{
                      echo "<div class='warning'>Invalid email format!</div>";
                    }
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
