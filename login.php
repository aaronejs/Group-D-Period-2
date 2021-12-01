<!doctype html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Log In</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php
          include './includes/header.php'; // Header
        ?>
        <main>
            <div class="center">
                <div class="formBox">
                    <div class="contentText">
                        <h2>Welcome</h2>
                        <h1>Log in to your account</h1>
                    </div>
                    <div class="form">
                      <form method="post" autocomplete="off">
                        <div>
                          <fieldset>
                            <legend>first name</legend>
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
                          <div>
                            <a href="#">Forgot your password?</a>
                          </div>
                        </div>
                        <div>
                          <input type="submit" name="login" value="Log in">
                        </div>
                        <div class="center">
                          <p>Don't have an account?</p> <a href="#">Sign up here!</a>
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
