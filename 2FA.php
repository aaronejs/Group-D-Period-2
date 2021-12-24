<!doctype html>
<html lang="en" dir="ltr">
<head>
  <title>2FA</title>
    <?php
    include './includes/head.html';
    include './includes/database.php';
    ?>
</head>
<body>
    <?php
    include './includes/header.php'; // header
    ?>
        <main>
          <div class="center">
            <div class="formBox">
                <div class="contentText">
                  <h2>Welcome</h2>
                </div>
                <div class="contentText">
                  <h1>Enter the code from your emaik</h1>
                </div>
                <div class="form">
                  <form method="post">
                    <div>
                      <fieldset>
                        <legend>code</legend>
                        <input type="text" name="code">
                      </fieldset>
                    </div>
                    <div>
                      <input type="submit" name="login" value="Log in">
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
                  }
                }
                if (isset($_POST['login'])) {
                  if(!empty($_POST['email']) && !empty($_POST['password'])){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ //validate email
                      $email = $_POST['email'];
                      $sql = "SELECT id, first_name, last_name, password, verified FROM user WHERE email = ?"; //query to insert into database
                      if($stmt = mysqli_prepare($conn, $sql)){ //database parses, compiles, and performs query optimization and stores w/o executing
                        mysqli_stmt_bind_param($stmt, "s", $email); //need to bind values to parameters
                        if(mysqli_stmt_execute($stmt)){ //execute the statement
                          mysqli_stmt_bind_result($stmt, $id, $firstname, $lastname, $password, $verified); //bind results
                          mysqli_stmt_store_result($stmt);
                          if(mysqli_stmt_num_rows($stmt) != 0){
                            while(mysqli_stmt_fetch($stmt)){
                              if (password_verify($_POST['password'], $password)) { //verify password
                                if($verified == 1){
                                  $_SESSION['firstname'] = $firstname; //set session variables to use across pages
                                  $_SESSION['lastname'] = $lastname;
                                  $_SESSION['sessionID'] = $id;
                                  $_SESSION['email'] = $email;
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
