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
        <main class="loginMain">
            <div class="middle">
                <div class="formarea">
                    <div class="textcontent">
                        <h1 class="welcome">Welcome</h1>
                        <h2 class="headlogin">Log in to your account</h2>
                    </div>
                    <div class="loginform">
                        <form method="post" autocomplete="on">
                            <div>
                                <label class="mailpassword" for="email">E-mail</label>
                                <fieldset class="loginField">
                                    <input class="loginInput" type="email" name="email">
                                </fieldset>
                            </div>
                            <div>
                                <label class="mailpassword" for="password">Password</label>
                                <fieldset class="loginField">
                                    <input class="loginInput" type="password" name="password">
                                </fieldset>
                            </div>
                            <div>
                                <input type="radio" name="Remember_me">
                                <label for="Remember_me">Remember me</label>
                                <a class="forgotpassword" ref="#">Forgot your password?</a>
                            </div>
                            <div>
                                <input class="loginButton" type="submit" name="Login" value="Log in">
                            </div>
                            <div>
                                <p class="paragraf">Forgot your account details?</p>
                                <a class="restore" ref="">Restore now</a>
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