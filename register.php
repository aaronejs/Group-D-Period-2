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
            $error = NULL;
            if (isset($_POST['register'])){
              if (!empty($_POST['firstname']) && !empty($_POST['lastname']) &&
                  !empty($_POST['password']) && !empty($_POST['passwordConfirm']) &&
                  !empty($_POST['email'])){ //check if all fields have been filled
                if($_POST['password'] == $_POST['passwordConfirm']){
                  if (strlen(trim($_POST['password'])) > 6) { //check if password is longer than 6 characters
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //validate email
                      $sql = "SELECT email FROM user WHERE email = ?";//query command to search if email already exists
                      if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
                        mysqli_stmt_bind_param($stmt, "s", $_POST['email']); //bind the param to be the email from the form
                        if(!mysqli_stmt_execute($stmt)){ //execute the statement
                          $error = "Error executing query" . mysqli_error($conn);
                          die(); //die if we cant execute statement
                        }
                        mysqli_stmt_store_result($stmt);
                        $emailHandle = substr($_POST['email'], strpos($_POST['email'], "@") + 1); //take a substring from email input
                        if (str_contains($emailHandle, 'nhlstenden')) { //if string contains 'nhlstenden' continue
                          if(mysqli_stmt_num_rows($stmt) == 0){ //if we get back no results then continue
                            $firstname = $_POST['firstname'];
                            $lastname = $_POST['lastname'];
                            $email = $_POST['email'];
                            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //hash password
                            $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES (?,?,?,?)"; //query to insert into database
                            if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
                              mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $password); //need to bind values to parameters
                              if(mysqli_stmt_execute($stmt)){ //check if we can execute the statement
                                mysqli_stmt_close($stmt); //close statement
                                mysqli_close($conn); //close connection
                                session_start(); //start a session
                                $_SESSION['email'] = $email; //make email into a session variable
                                $_SESSION["vkey"] = hash('sha256', time().$email); //hashed verification code
                                header("location: ./sendmail.php"); //redirect back to register page with message
                              }else{
                                $error = "Error: " . mysqli_error($conn);
                                die(); //die if we cant execute statement
                              }
                            }else{
                              $error = "Error: " . mysqli_error($conn);
                              die(); //die if we cant prepare statement
                            }
                          }else{
                            $error = "Email already exists!";
                          }
                        }else{
                          $error = "Not a valid NHL Stenden email!";
                        }
                      }else{
                        $error = "Error: " . mysqli_error($conn);
                      }
                    }else{
                      $error = "Invalid email format!";
                    }
                  }else {
                    $error = "Password must be longer than 6 characters!";
                  }
                }else{
                  $error = "Passwords do not match!";
                }
              }else {
                $error = "Please fill in all fields!";
              }
              if($error != NULL){ //echo error if the variable has been set
                echo "<div class='warning'>".$error."</div>";
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
