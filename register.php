<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login!</title>
  <!--
  </head>
  <body>
  -->
    <?php
    include './includes/header.php'; // Header
    ?>
      <main>
        <div class="center">
          <div class="formBox">
            <div class="contentText">
              <h2>Create a new account</h2>
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
          </div>
        </div>
      </main>
      <?php
      include './includes/footer.html'; // Footer
      ?>
    </div>
  </body>
</html>
