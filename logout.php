<?php
session_start();
session_destroy();
if(isset($_COOKIE['userid']) && isset($_COOKIE['token'])) {
    $hour = time() - 5;
    setcookie('userid', "", $hour);
    setcookie('token', "", $hour);
}
header("location:./index.php?success=logout");
?>
