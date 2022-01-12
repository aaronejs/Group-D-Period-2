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
    var_dump($_SESSION['token_factor']);

    if (isset($_POST['code'])) {
      if($_POST['code'] == $_SESSION['token_factor']) {
        var_dump(111); 
        header("location:./index.php?success=login");
      } else {
        var_dump(11155); 
        header("location:./login.php");
      }
    } else {
      $mrand = rand(1000, 9999);
      $_SESSION['token_factor'] = $mrand;
      
      $to      = 'nobody@example.com';
      $subject = 'the subject';
      $message = 'hello';

      mail($to, $subject, $message, $headers);
      //СГЕНЕРИТЬ РАНДОМНОЕ ЧИСЛО И ЗАПИ[НУТЬ В СЕССИОН
      <INSERT>J 
      #endregion
      </INSERT>

      //ОТПРАВИТЬ ЕГО ПО ИМЕЙЛУ

    }
    ?>
        <main>
          <div class="center">
            <div class="formBox">
                <div class="contentText">
                <h2>Enter the code from your email</h2>
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

                ?>
            </div>
          </div>
        </main>
        <?php
          include './includes/footer.html'; // Footer
        ?>
    </body>
</html>
