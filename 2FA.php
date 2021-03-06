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
    //  creating 2FA code and putting it in session 
    if(!isset($_SESSION['token_factor'])){
      $mrand = rand(1000, 9999);
      $_SESSION['token_factor'] = $mrand;
      $to      = $_SESSION['temp_email'];
      $subject = '2FA code';
      $message = $_SESSION['token_factor'];
      $header = "From: test.nhlstenden@gmail.com \r\n";
      $header .= "MIME-Version: 1.0" . "\r\n";
      $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      // mail function
      if(!mail($to, $subject, $message, $header)){
        session_unset();
        session_destroy();
        header('location: ./index.php?error=2fa');
      }
    }
    if (isset($_POST['login'])) {
      if($_POST['code'] == $_SESSION['token_factor']) {
        $firstname = $_SESSION['temp_firstname']; //set session variables to use across pages
        $lastname = $_SESSION['temp_lastname'];
        $id = $_SESSION['temp_sessionID'];
        $emal = $_SESSION['temp_email'];
        $type = $_SESSION['temp_type'];
        if($_SESSION['rememberLogin']){
          $sql = "UPDATE user set token = ? WHERE id = ?";
          if($stmt = mysqli_prepare($conn, $sql)){
            $token = time().$id;
            mysqli_stmt_bind_param($stmt, "ss", $token, $_SESSION['temp_sessionID']);
            if(!mysqli_stmt_execute($stmt)){ //execute the statement
              $error = "Error executing query" . mysqli_error($conn);
              die();
            }else{
              $token = password_hash($token, PASSWORD_DEFAULT);
              $hour = time() + 3600 * 24 * 30;
              setcookie('userid', $id, $hour);
              setcookie('token', $token, $hour);
              session_unset();
              $_SESSION['firstname'] = $firstname; //set session variables to use across pages
              $_SESSION['lastname'] = $lastname;
              $_SESSION['sessionID'] = $id;
              $_SESSION['email'] = $email;
              $_SESSION['type'] = $type;
              header("location:./index.php?success=login");
            }
          }else{
            echo "broken";
          }
        }else{
          session_unset();
          $_SESSION['firstname'] = $firstname; //set session variables to use across pages
          $_SESSION['lastname'] = $lastname;
          $_SESSION['sessionID'] = $id;
          $_SESSION['email'] = $email;
          $_SESSION['type'] = $type;
          header("location:./index.php?success=login");
        }
      } else {
        session_unset();
        header("location:./login.php?error=2FA");
      }
    }
    ?>
      <main>
        <div class="center">
          <div class="formBox">
            <div class="contentText">
              <h2>Enter the code from your email!</h2>
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
          </div>
        </div>
      </main>
      <?php
        include './includes/footer.html'; // Footer
      ?>
    </body>
</html>
