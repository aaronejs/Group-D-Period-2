<!doctype html>
<html lang="en" dir="ltr">
<head>
  <title>Log In</title>
    <?php
    include './includes/head.html';
    include './includes/database.php';
    ?>
</head>
<body>
    <?php
    include './includes/header.php'; // header
    if(isset($_SESSION['sessionID'])) {
      header('location:./index.php?error=login');
    }
    ?>
        <main>
          <div class="center">
            <div class="formBox">
                <div class="contentText">
                  <h2>Welcome</h2>
                </div>
                <div class="contentText">
                  <h1>Log in to your account</h1>
                </div>
                <div class="form">
                  <form method="post">
                    <div>
                      <fieldset>
                        <legend>email</legend>
                        <input type="text" name="email">
                      </fieldset>
                    </div>
                    <div>
                      <fieldset>
                        <legend>password</legend>
                        <input type="password" name="password">
                      </fieldset>
                    </div>
                    <div class="right">
                      <div>
                        <input type="checkbox" name="rememberLogin" value="rememberLogin" id="remember">
                        Remember me
                      </div>
                      <div class="right">
                        <a href="#">Forgot your password?</a>
                      </div>
                    </div>
                    <div>
                      <input type="submit" name="login" value="Log in">
                    </div>
                    <div class="center">
                      <p>Don't have an account?</p> <a href="./register.php">Sign up here!</a>
                    </div>
                  </form>
                </div>
                <?php
                $error = NULL;
                if(isset($_GET['success'])){
                  if ($_GET['success'] == "verified") {
                    $success = "Verification successful, you may now log in!";
                    echo "<div class='success'>".$success."</div>";
                  }
                }elseif(isset($_GET['error'])){
                  if($_GET['error'] == "login"){
                    echo "<div class='warning'>Please log in to use the service!</div>";
                  }elseif ($_GET['error'] == "2FA") {
                    echo "<div class='warning'>2FA code invalid!</div>";
                  }
                }
                if (isset($_POST['login'])) {
                  if(!empty($_POST['email']) && !empty($_POST['password'])){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //validate email
                      $email = $_POST['email'];
                      $sql = "SELECT id, first_name, last_name, password, 2FA, verified, user_type FROM user WHERE email = ?"; //query to insert into database
                      if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
                        mysqli_stmt_bind_param($stmt, "s", $email); //need to bind values to parameters
                        if(mysqli_stmt_execute($stmt)){ //execute the statement
                          mysqli_stmt_bind_result($stmt, $id, $firstname, $lastname, $password, $twoFactor, $verified, $type); //bind results
                          mysqli_stmt_store_result($stmt);
                          if(mysqli_stmt_num_rows($stmt) != 0){
                            while(mysqli_stmt_fetch($stmt)){
                              if (password_verify($_POST['password'], $password)) { //verify password
                                if($verified == 1){
                                  if($twoFactor == 0){
                                    $_SESSION['firstname'] = $firstname; //set session variables to use across pages
                                    $_SESSION['lastname'] = $lastname;
                                    $_SESSION['sessionID'] = $id;
                                    $_SESSION['email'] = $email;
                                    $_SESSION['type'] = $type;
                                    if(isset($_POST['rememberLogin'])){
                                      $sql = "UPDATE user set token = ? WHERE id = ?";
                                      if($stmt = mysqli_prepare($conn, $sql)){
                                        $token = time().$id;
                                        mysqli_stmt_bind_param($stmt, "ss", $token, $id);
                                        if(!mysqli_stmt_execute($stmt)){ //execute the statement
                                          $error = "Error executing query" . mysqli_error($conn);
                                          die();
                                        }else{
                                          $token = password_hash($token, PASSWORD_DEFAULT);
                                          $hour = time() + 3600 * 24 * 30;
                                          setcookie('userid', $id, $hour);
                                          setcookie('token', $token, $hour);
                                        }
                                      }
                                    }
                                    header("location:./index.php?success=login");
                                  }else{
                                    $_SESSION['temp_firstname'] = $firstname; //set session variables to use across pages
                                    $_SESSION['temp_lastname'] = $lastname;
                                    $_SESSION['temp_sessionID'] = $id;
                                    $_SESSION['temp_email'] = $email;
                                    $_SESSION['temp_type'] = $type;
                                    if(isset($_POST['rememberLogin'])){
                                      $_SESSION['rememberLogin'] = true;
                                    }
                                    header('location: ./2FA.php');
                                  }
                                }else{
                                  $error = "Account not verified!";
                                }
                              } else {
                                $error = "Incorrect password!";
                              }
                            }
                          }else {
                            $error = "Incorrect email!";
                          }
                        }else {
                          echo "Error executing query";
                          die(mysqli_error($conn));
                        }
                      }else{
                        die(mysqli_error($conn));
                      }
                    }else {
                      $error = "Invalid email!";
                    }
                  }else {
                    $error = "Please fill in all the fields!";
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
    </body>
</html>
